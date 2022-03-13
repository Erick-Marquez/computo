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

class InvoiceService
{

    const ACCEPTED = 'ACEPTADO';
    const REJECTED = 'RECHAZADO';
    const SENT = 'ENVIADO';
    const PENDIENTE = 'PENDIENTE';
    const VOIDED = 'ANULADO';

    private $directoryXml = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'Xml'.DIRECTORY_SEPARATOR;
    private $directoryZip = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
    private $directoryCdr = 'Facturacion'.DIRECTORY_SEPARATOR.'Factura'.DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
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

    public function setDataInvoice(Array $data)
    {
        $this->sale = $data['sale'];
        $this->voided = $data['voided'];
        $this->identifier = $this->voided['identifier'];
        $this->setDirectories();
    }

    private function setDirectories()
    {
        $this->nameXml = $this->company['ruc'] . '-' . $this->identifier . '.xml';
        $this->nameZip = $this->company['ruc'] . '-' . $this->identifier . '.zip';
        $this->zipPath  = storage_path('app'.DIRECTORY_SEPARATOR.$this->directoryZip.$this->nameZip);
    }

}