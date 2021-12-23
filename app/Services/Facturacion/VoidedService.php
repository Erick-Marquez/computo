<?php

namespace App\Services\Facturacion;

use App\Services\Facturacion\Exception\TicketSunatOutOfServiceException;
use App\Services\Facturacion\Exception\TicketSunatRejectedException;
use App\Services\Facturacion\Exception\XmlSunatOutOfServiceException;
use App\Services\Facturacion\Exception\XmlSunatRejectedException;
use DOMDocument;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use ZipArchive;

class VoidedService
{

    const ACCEPTED = 'ACEPTADO';
    const REJECTED = 'RECHAZADO';
    const SENT = 'ENVIADO';
    const PENDIENTE = 'PENDIENTE';
    const VOIDED = 'ANULADO';

    private $directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
    private $directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
    private $directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Baja'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
    private $directoryCertificate;
    private $zipPath;

    private $webServiceSunat;
    private $ticket;
    private $identifier;

    private $company;
    private $sale;
    private $voided;
    private $nameXml;
    private $nameZip;

    private $message;

    public function __construct(Array $company) 
    {
        $this->company = $company;
        if ($this->company['is_demo']) { 
            $this->directoryCertificate = storage_path('app'.DIRECTORY_SEPARATOR.'Facturacion'.DIRECTORY_SEPARATOR.'Certificado'.DIRECTORY_SEPARATOR.'Demo'.DIRECTORY_SEPARATOR.'certificado.pem');
            $this->company['user_sol'] = 'MODDATOS';
            $this->company['password_sol'] = 'moddatos';
            $this->webServiceSunat = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService';
        }
        else{
            $this->directoryCertificate = storage_path('app'.DIRECTORY_SEPARATOR.'Facturacion'.DIRECTORY_SEPARATOR.'Certificado'.DIRECTORY_SEPARATOR.'Produccion'.DIRECTORY_SEPARATOR.'certificado.pem');
            $this->webServiceSunat = 'https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService';
        }
    }

    public function setDataVoided(Array $data)
    {
        $this->sale = $data['sale'];
        $this->voided = $data['voided'];
        $this->identifier = $this->voided['identifier'];
        $this->setDirectories();
    }

    public function setTicket(String $ticket, String $identifier)
    {
        $this->ticket = $ticket;
        $this->identifier = $identifier;
        $this->setDirectories();
    }

    private function setDirectories()
    {
        $this->nameXml = $this->company['ruc'] . '-' . $this->identifier . '.xml';
        $this->nameZip = $this->company['ruc'] . '-' . $this->identifier . '.zip';
        $this->zipPath  = storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryZip.$this->nameZip);
    }

    public function createXml()
    {
        // Crear plantilla xml
        View::addLocation(__DIR__.'/Templates');
        $templateXml = view('voided')
            ->with('company', $this->company)
            ->with('sale', $this->sale)
            ->with('voided', $this->voided)
            ->render();
        
        // Convierte el string a un elemento simplexml
        $sxe = simplexml_load_string($templateXml);
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
        Storage::disk('local')->put($this->directoryXml . $this->nameXml, $xml);
        $this->message['response']['xml_creado'] = true;
    }

    public function singXml()
    {
        // Extrae el Xml
        $xmlPath = storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryXml.$this->nameXml);
        // Se crea el objeto que nos ayuda a firmar
        $signer = new SignedXml();
        $signer->setCertificateFromFile($this->directoryCertificate);
        $xmlSigned = $signer->signFromFile($xmlPath);

        // Guardo el xml firmado
        Storage::disk('local')->put($this->directoryXml.$this->nameXml, $xmlSigned);

        // Determinar mensajes de respuesta

        $docCpe = new DOMDocument();
        $docCpe->load(storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryXml.$this->nameXml));

        $this->message['response']['xml_signed'] = true;
        $this->message['response']['hash_cpe'] = $docCpe->getElementsByTagName('DigestValue')->item(0)->nodeValue;
    }

    public function zipXml()
    {
        $zip = new ZipArchive();

        $xmlSignedPath = storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryXml.$this->nameXml);
        if ($zip->open($this->zipPath, ZipArchive::CREATE) === true) {
            $zip->addFile($xmlSignedPath, $this->nameXml); //Origen , Nombre Destino
            $zip->close();
        }
        $this->message['response']['zip'] = true;
    }

    public function sendXmlSunat()
    {
        // Comprimir en base 64 el zip generado
        $zipSend = base64_encode(file_get_contents($this->zipPath));

        $xmlSend = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe"
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
        <soapenv:Header>
            <wsse:Security>
                <wsse:UsernameToken>
                    <wsse:Username>' . $this->company['ruc'] . $this->company['user_sol'] . '</wsse:Username>
                    <wsse:Password>' . $this->company['password_sol'] . '</wsse:Password>
                </wsse:UsernameToken>
            </wsse:Security>
        </soapenv:Header>
        <soapenv:Body>
            <ser:sendSummary>
                <fileName>' . $this->nameZip . '</fileName>
                <contentFile>' . $zipSend . '</contentFile>
            </ser:sendSummary>
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
        curl_setopt($ch, CURLOPT_URL, $this->webServiceSunat); // Url con el cual se comunica    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Recibire un retorno
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); // Tipo de autorizacion
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo de espera  de respuesta 5s
        curl_setopt($ch, CURLOPT_POST, true); // Se enviara Datos por post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlSend); // El xml de envio
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Cabecera de la comunicacion

        //---------------- Obtener CDR --------------------

        $response =  curl_exec($ch); // Respuesta del web service Sunat
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener el codigo de verificacion

        curl_close($ch);

        if ($httpCode !== 200) {

            $this->message['response']['state'] = $this::PENDIENTE;
            $this->message['response']['send'] = false;

            throw new XmlSunatOutOfServiceException("Sunat Fuera de Servicio, vuelva a intentar en unos minutos.");
        }

        $this->message['response']['send'] = true;
        $doc = new DOMDocument();
        $doc->loadXML($response);

        if (!isset($doc->getElementsByTagName('ticket')->item(0)->nodeValue)) { //Si no existe una etiquta de respuesta
            $this->message['response']['response_sunat'] = false;
            $this->message['response']['state'] = $this::REJECTED;
            $this->message['response']['cod'] = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue; // Codigo de error
            $this->message['response']['message'] = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue; // Mensaje de error

            throw new XmlSunatRejectedException("El comprobante enviado tiene observaciones y ha sido rechazado por Sunat.");
        }

        $this->ticket = $doc->getElementsByTagName('ticket')->item(0)->nodeValue; // Obtener el valor del ticket

        $this->message['response']['response_sunat'] = true;
        $this->message['response']['response_sunat_ticket'] = false;
        $this->message['response']['state'] = $this::SENT;
        $this->message['response']['cod_ticket'] = $this->ticket;
        
    }

    public function sendTicketSunat()
    {
        $xmlSend = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe"
        xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
        <soapenv:Header>
            <wsse:Security>
                <wsse:UsernameToken>
                    <wsse:Username>' . $this->company['ruc'] . $this->company['user_sol'] . '</wsse:Username>
                    <wsse:Password>' . $this->company['password_sol'] . '</wsse:Password>
                </wsse:UsernameToken>
            </wsse:Security>
        </soapenv:Header>
        <soapenv:Body>
            <ser:getStatus>
                <ticket>' . $this->ticket . '</ticket>
            </ser:getStatus>
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
        curl_setopt($ch, CURLOPT_URL, $this->webServiceSunat); // Url con el cual se comunica    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Recibire un retorno
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); // Tipo de autorizacion
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Tiempo de espera  de respuesta 5s
        curl_setopt($ch, CURLOPT_POST, true); // Se enviara Datos por post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlSend); // El xml de envio
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Cabecera de la comunicacion

        //---------------- Obtener CDR --------------------

        $response =  curl_exec($ch); // Respuesta del web service Sunat
        
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener el codigo de verificacion

        curl_close($ch);

        if ($httpCode !== 200) {

            $this->message['ticket']['state'] = self::PENDIENTE;
            $this->message['ticket']['response_sunat'] = false;
            $this->message['ticket']['send'] = false;

            throw new TicketSunatOutOfServiceException("Sunat Fuera de Servicio");
        }

        $this->message['ticket']['send'] = true;
        $doc = new DOMDocument();
        $doc->loadXML($response);

        if (!isset($doc->getElementsByTagName('content')->item(0)->nodeValue)) { //Si no existe una etiquta de respuesta

            $this->message['ticket']['response_sunat'] = false;
            $this->message['ticket']['state'] = $this::REJECTED;
            $this->message['ticket']['response']['cod'] = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue; // Codigo de error
            $this->message['ticket']['response']['message'] = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue; // Mensaje de error

            throw new TicketSunatRejectedException("El ticket enviado tiene observaciones y ha sido rechazado por Sunat.");
        }


        $this->message['ticket']['response_sunat'] = true;
        $this->message['ticket']['state'] = $this::ACCEPTED;
        $this->message['response']['response_sunat_ticket'] = true;
        
        $cdr = $doc->getElementsByTagName('content')->item(0)->nodeValue; // Obtener el valor de la etiqueta de respuesta
        $cdr = base64_decode($cdr); // Descodificar la respuesta
        // Guardo el archivo cdr
        Storage::disk('local')->put($this->directoryCdr.'R-'.$this->nameZip, $cdr);

    }

    public function getCdr()
    {
        //extraemos archivo zip a xml
        $zipCdrPath = storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryCdr);  
        $zip = new ZipArchive;
        if ($zip->open($zipCdrPath.'R-'.$this->nameZip) === TRUE) {
            $zip->extractTo($zipCdrPath, 'R-'.$this->nameXml);
            $zip->close();
        }
        //=============hash CDR=================
        $docCdr = new DOMDocument();
        $docCdr->load($zipCdrPath.'R-'.$this->nameXml);
        $this->message['response']['cod'] = $docCdr->getElementsByTagName('ResponseCode')->item(0)->nodeValue;
        $this->message['response']['message'] = $docCdr->getElementsByTagName('Description')->item(0)->nodeValue;
        $this->message['response']['hash_cdr'] = $docCdr->getElementsByTagName('DigestValue')->item(0)->nodeValue;
    }

    public function getResponse(): Array
    {
        return $this->message;
    }

}