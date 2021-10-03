{!! '<?xml version="1.0" encoding="utf-8" standalone="no"?>' !!}
<VoidedDocuments xmlns="urn:sunat:names:specification:ubl:peru:schema:xsd:VoidedDocuments-1"
                 xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
                 xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
                 xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
                 xmlns:sac="urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1"
                 xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.0</cbc:CustomizationID>
    <cbc:ID>{{ $document->identifier }}</cbc:ID>
    <cbc:ReferenceDate>{{ $document->date_of_reference->format('Y-m-d') }}</cbc:ReferenceDate>
    <cbc:IssueDate>{{ $document->date_of_issue->format('Y-m-d') }}</cbc:IssueDate>
    <cac:AccountingSupplierParty>
        <cbc:CustomerAssignedAccountID>{{ $company->ruc }}</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[{{ $company->name }}]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <sac:VoidedDocumentsLine>
        <cbc:LineID>1</cbc:LineID>
        <cbc:DocumentTypeCode>codigo del tipo de docuento</cbc:DocumentTypeCode>
        <sac:DocumentSerialID>serie a dar de baja</sac:DocumentSerialID>
        <sac:DocumentNumberID>numero a dar de baja</sac:DocumentNumberID>
        <sac:VoidReasonDescription><![CDATA[Motivo de baja]]></sac:VoidReasonDescription>
    </sac:VoidedDocumentsLine>
</VoidedDocuments>