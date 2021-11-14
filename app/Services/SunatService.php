<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CreditNote;
use App\Models\DebitNote;
use App\Models\Sale;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use ZipArchive;

class SunatService
{
    
    private static $sale;
    private static $creditNote; 
    private static $debitNote; 
    private static $company;
    private static $data;    

    private static $directoryXml; 
    private static $directoryZip; 
    private static $directoryCdr;
    private static $templateXml;
    private static $nameXml;
    private static $nameZip;
    private static $zipPath;

    private static $message;

    public static function facturar($id, $type)
    {   
        // self::$message = [
        //     'xml' => [
        //         'creado' => null,
        //         'firmado' => null
        //     ],
        //     'zip' => null,
        //     'send' => null,
        //     'response' => [
        //         "cod" => null,
        //         'message' => null,
        //         'hash_cdr' => null
        //     ]
        // ];
        self::template($id, $type);
        self::createXml(); // Factura, Boleta, Nota Credito, Nota Debito
        self::signXml();
        self::zipXml();
        self::sendSunat();
        return self::$message;
    }

    public static function getSale($id)
    {
        self::$sale = Sale::findorFail($id);
        self::$company = Company::findorFail(1);

        self::$data = [
            'sale' => self::$sale,
            'company' => self::$company
        ];
    }

    public static function getCredit($id)
    {
        self::$creditNote = CreditNote::findorFail($id);
        self::$company = Company::findorFail(1);

        self::$data = [
            'credit' => self::$creditNote,
            'company' => self::$company
        ];
    }

    public static function getDebit($id)
    {
        self::$debitNote = DebitNote::findorFail($id);
        self::$company = Company::findorFail(1);

        self::$data = [
            'debit' => self::$debitNote,
            'company' => self::$company
        ];
    }

    public static function createXml()
    {
        // Convierte el string a un elemento simplexml
        $sxe = simplexml_load_string(self::$templateXml);
        $domSxe = dom_import_simplexml($sxe);
         
        $dom = new DOMDocument();
        $dom->formatOutput = false;
        $dom->preserveWhiteSpace = true;
        $dom->encoding = 'utf-8';
        
        $domSxe = $dom->importNode($domSxe, true);
        $domSxe = $dom->appendChild($domSxe);
        // Se guarda el objeto en string  
        $xml = $dom->saveXML();
        // Se guarda el string como tipo xml 
        Storage::disk('local')->put(self::$directoryXml.self::$nameXml, $xml);
        self::$message['xml']['creado'] = true;

    }


    public static function signXml()
    {
        //---------------- Firmar el Xml --------------------
        // Extrae el Xml
        $xmlPath = storage_path('app'.DIRECTORY_SEPARATOR.self::$directoryXml.self::$nameXml);
        // Extrae el certificado en .pem
        $certPath = storage_path('app'.DIRECTORY_SEPARATOR.'Facturacion'.DIRECTORY_SEPARATOR.'Certificado'.DIRECTORY_SEPARATOR.'Demo'.DIRECTORY_SEPARATOR.'certificado.pem');

        $signer = new SignedXml();
        $signer->setCertificateFromFile($certPath);
        $xmlSigned = $signer->signFromFile($xmlPath);

        // Guardo el xml firmado
        Storage::disk('local')->put(self::$directoryXml.self::$nameXml, $xmlSigned);
        self::$message['xml']['firmado'] = true;
    }

    public static function zipXml()
    {    
        //---------------- Zipear el xml --------------------
        $zip = new ZipArchive();

        self::$zipPath = storage_path('app'.DIRECTORY_SEPARATOR.self::$directoryZip.self::$nameZip);
        $xmlSignedPath = storage_path('app'.DIRECTORY_SEPARATOR.self::$directoryXml.self::$nameXml);
        if ($zip->open(self::$zipPath, ZipArchive::CREATE) === true) {
            $zip->addFile($xmlSignedPath, self::$nameXml); //Origen , Nombre Destino
            $zip->close();
        }
        self::$message['zip'] = true;
        
    }

    public static function sendSunat()
    {
        
        //---------------- Enviar el xml --------------------
        // Comprimir en base 64 el zip generado
        $zipSend = base64_encode(file_get_contents(self::$zipPath));
        $usuarioSol = 'MODDATOS';
        $passSol = 'moddatos';
        $ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService"; // Url beta

        $xmlSend = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe"
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
        <soapenv:Header>
            <wsse:Security>
                <wsse:UsernameToken>
                    <wsse:Username>' . self::$company->ruc . $usuarioSol . '</wsse:Username>
                    <wsse:Password>' . $passSol . '</wsse:Password>
                </wsse:UsernameToken>
            </wsse:Security>
        </soapenv:Header>
        <soapenv:Body>
            <ser:sendBill>
                <fileName>' . self::$nameZip . '</fileName>
                <contentFile>' . $zipSend . '</contentFile>
            </ser:sendBill>
        </soapenv:Body>
        </soapenv:Envelope>';

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: ",
            "Content-length: " . strlen($xmlSend),
        );

        $ch = curl_init(); // Establecer una comunicacion HTTP
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); // Verificar SSL
        curl_setopt($ch, CURLOPT_URL, $ws); // Url con el cual se comunica    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Recibire un retorno
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); // Tipo de autorizacion
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo de espera  de respuesta 5s
        curl_setopt($ch, CURLOPT_POST, true); // Se enviara Datos por post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlSend); // El xml de envio
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Cabecera de la comunicacion

        // Certificado para pruebas en local en produccion no aplica
        $cacertPath = storage_path('app'.DIRECTORY_SEPARATOR.'Facturacion'.DIRECTORY_SEPARATOR.'cacert.pem');
        curl_setopt($ch, CURLOPT_CAINFO, $cacertPath);

        //---------------- Obtener CDR --------------------

        $response =  curl_exec($ch); // Respuesta del web service Sunat
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener el codigo de verificacion

        
        if ($httpCode == 200) {
            self::$message['send'] = true;
            $doc = new DOMDocument();
            $doc->loadXML($response);
            if (isset($doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue)) { //Si existe una etiquta de respuesta
                self::$message['response_sunat'] = true;
                $cdr = $doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue; // Obtener el valor de la etiqueta de respuesta
                $cdr = base64_decode($cdr); // Descodificar la respuesta
                // Guardo el archivo cdr
                Storage::disk('local')->put(self::$directoryCdr.'R-'.self::$nameZip, $cdr);
                self::getCdr();

            } else {
                self::$message['response_sunat'] = false;
                self::$message['state'] = Sale::RECHAZADO;
                self::$message['response']['cod'] = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue; // Codigo de error
                self::$message['response']['message'] = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue; // Mensaje de error
                self::$message['response']['hash_cdr'] = "Error";
            }
            
        } else {
            self::$message['state'] = Sale::PENDIENTE;
            self::$message['send'] = false;
        }
        curl_close($ch);

        
    }

    public static function getCdr()
    {
        //extraemos archivo zip a xml
        $zipCdrPath = storage_path('app'.DIRECTORY_SEPARATOR.self::$directoryCdr);
        $zip = new ZipArchive;
        if ($zip->open($zipCdrPath.'R-'.self::$nameZip) === TRUE) {
            $zip->extractTo($zipCdrPath, 'R-'.self::$nameXml);
            $zip->close();
        }
        //=============hash CDR=================
        $docCdr = new DOMDocument();
        $docCdr->load($zipCdrPath.'R-'.self::$nameXml);
        self::$message['state'] = Sale::ACEPTADO;
        self::$message['response']['cod'] = $docCdr->getElementsByTagName('ResponseCode')->item(0)->nodeValue;
        self::$message['response']['message'] = $docCdr->getElementsByTagName('Description')->item(0)->nodeValue;
        self::$message['response']['hash_cdr'] = $docCdr->getElementsByTagName('DigestValue')->item(0)->nodeValue;
    }

    public static function template($id, $type)
    {
        switch ($type) {
            case 'ticket':
                // Obtener datos nesesarios para la boleta
                self::getSale($id);
                // Obtener los nombres de los archivos
                self::$nameXml = self::$company->ruc.'-'.self::$sale->serie->voucherType->cod.'-'.self::$sale->serie->serie.'-'.self::$sale->document_number.'.xml';
                self::$nameZip = self::$company->ruc.'-'.self::$sale->serie->voucherType->cod.'-'.self::$sale->serie->serie.'-'.self::$sale->document_number.'.zip';
                // Crear plantilla xml
                $sale = self::$sale;
                $company = self::$company;
                $data = self::$data;

                self::$templateXml = view('templates.xml.invoice',compact('sale', 'company'))->render();

                // Obtener los directorios para guardar
                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Boleta'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Boleta'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Boleta'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;

            case 'invoice':
                
                // Obtener datos nesesarios para la factura
                self::getSale($id);
                // Obtener los nombres de los archivos
                self::$nameXml = self::$company->ruc.'-'.self::$sale->serie->voucherType->cod.'-'.self::$sale->serie->serie.'-'.self::$sale->document_number.'.xml';
                self::$nameZip = self::$company->ruc.'-'.self::$sale->serie->voucherType->cod.'-'.self::$sale->serie->serie.'-'.self::$sale->document_number.'.zip';
                // Crear plantilla xml
                $sale = self::$sale;
                $company = self::$company;
                self::$templateXml = view('templates.xml.invoice',compact('sale', 'company'))->render();

                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;
            
            case 'credit':
                // Obtener datos nesesarios para la nota de credito
                self::getCredit($id);
                // Obtener los nombres de los archivos
                self::$nameXml = self::$company->ruc.'-'.self::$creditNote->serie->voucherType->cod.'-'.self::$creditNote->serie->serie.'-'.self::$creditNote->document_number.'.xml';
                self::$nameZip = self::$company->ruc.'-'.self::$creditNote->serie->voucherType->cod.'-'.self::$creditNote->serie->serie.'-'.self::$creditNote->document_number.'.zip';
                // Crear plantilla xml
                $creditNote = self::$creditNote;
                $company = self::$company;
                self::$templateXml = view('templates.xml.credit',compact('creditNote', 'company'))->render();

                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaCredito'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaCredito'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaCredito'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;

            case 'debit':
                // Obtener datos nesesarios para la nota de debito
                self::getDebit($id);
                // Obtener los nombres de los archivos
                self::$nameXml = self::$company->ruc.'-'.self::$debitNote->serie->voucherType->cod.'-'.self::$debitNote->serie->serie.'-'.self::$debitNote->document_number.'.xml';
                self::$nameZip = self::$company->ruc.'-'.self::$debitNote->serie->voucherType->cod.'-'.self::$debitNote->serie->serie.'-'.self::$debitNote->document_number.'.zip';
                // Crear plantilla xml
                $debitNote = self::$debitNote;
                $company = self::$company;
                self::$templateXml = view('templates.xml.debit',compact('debitNote', 'company'))->render();

                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaDebito'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaDebito'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'NotaDebito'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;
            
            case 'summary':

                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Resumen'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Resumen'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Resumen'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;
            
            case 'voided':

                self::$directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
                self::$directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
                self::$directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            break;
            
            default:
                return true;
            break;
        }

    }
}