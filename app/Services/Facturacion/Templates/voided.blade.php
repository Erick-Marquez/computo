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
    <cbc:ID>{{ $voided['identifier'] }}</cbc:ID>
    <cbc:ReferenceDate>{{ $sale['date_reference'] }}</cbc:ReferenceDate>
    <cbc:IssueDate>{{ $voided['date_issue'] }}</cbc:IssueDate>
    <cac:Signature>
        <cbc:ID>{{ $voided['identifier'] }}</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>{{ $company['ruc'] }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[ {{ $company['comercial_name'] }} ]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#{{ $voided['identifier'] }}</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cbc:CustomerAssignedAccountID>{{ $company['ruc'] }}</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[ {{ $company['name'] }} ]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <sac:VoidedDocumentsLine>
        <cbc:LineID>1</cbc:LineID>
        <cbc:DocumentTypeCode>{{ $sale['voucher_type'] }}</cbc:DocumentTypeCode>
        <sac:DocumentSerialID>{{ $sale['serie'] }}</sac:DocumentSerialID>
        <sac:DocumentNumberID>{{ $sale['document_number'] }}</sac:DocumentNumberID>
        <sac:VoidReasonDescription><![CDATA[ {{ $voided['description'] }} ]]></sac:VoidReasonDescription>
    </sac:VoidedDocumentsLine>
</VoidedDocuments>