{!! '<?xml version="1.0" encoding="utf-8" standalone="no"?>' !!}
<DebitNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2"
           xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
           xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
           xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
           xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <!-- GENERADO DESDE  -->
    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>2.0</cbc:CustomizationID>
    <cbc:ID>{{ $debitNote->serie->serie }}-{{ $debitNote->document_number }}</cbc:ID>
    <cbc:IssueDate>{{ $debitNote->date_issue }}</cbc:IssueDate>
    <cbc:IssueTime>00:00:00</cbc:IssueTime>
    <cbc:Note languageLocaleID="1000">TREINTA Y UN MIL OCHOCIENTOS CON 00/100 SOLES</cbc:Note>
    <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listAgencyName="United Nations Economic Commission for Europe" listName="Currency">PEN</cbc:DocumentCurrencyCode>
    <cac:DiscrepancyResponse>
        <cbc:ReferenceID>{{ $debitNote->sale->serie->serie }}-{{ $debitNote->sale->document_number }}</cbc:ReferenceID>
        <cbc:ResponseCode>{{ $debitNote->debitNoteType->id }}</cbc:ResponseCode>
        <cbc:Description>{{ $debitNote->observation }}</cbc:Description>
    </cac:DiscrepancyResponse>
    <cac:BillingReference>
        <cac:InvoiceDocumentReference>
            <cbc:ID>{{ $debitNote->sale->serie->serie }}-{{ $debitNote->sale->document_number }}</cbc:ID>
            <cbc:DocumentTypeCode>{{ $debitNote->sale->serie->voucherType->cod }}</cbc:DocumentTypeCode>
        </cac:InvoiceDocumentReference>
    </cac:BillingReference>
    <cac:AccountingSupplierParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="6" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $company->ruc }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[{{ $company->comercial_name }}]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyTaxScheme>
                <cbc:RegistrationName><![CDATA[{{ $company->name }}]]></cbc:RegistrationName>
                <cbc:CompanyID schemeID="6" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $company->ruc }}</cbc:CompanyID>
                <cac:RegistrationAddress>
                    <cbc:AddressTypeCode>0000</cbc:AddressTypeCode>
                </cac:RegistrationAddress>
                <cac:TaxScheme>
                    <cbc:ID schemeID="6" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $company->ruc }}</cbc:ID>
                </cac:TaxScheme>
            </cac:PartyTaxScheme>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[{{ $company->name }}]]></cbc:RegistrationName>
                <cac:RegistrationAddress>
                    <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI">{{ $company->ubigeo }}</cbc:ID>
                    <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0000</cbc:AddressTypeCode>
                    <cbc:CityName><![CDATA[Huánuco]]></cbc:CityName>
                    <cbc:CountrySubentity><![CDATA[Huánuco]]></cbc:CountrySubentity>
                    <cbc:District><![CDATA[Huanuco]]></cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[{{ $company->address }}]]></cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
            <cac:Contact>
                <cbc:Name><![CDATA[]]></cbc:Name>
            </cac:Contact>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="{{ $debitNote->sale->customer->identificationDocument->id }}" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $debitNote->sale->customer->document }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[{{ $debitNote->sale->customer->name }}]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyTaxScheme>
                <cbc:RegistrationName><![CDATA[{{ $debitNote->sale->customer->name }}]]></cbc:RegistrationName>
                <cbc:CompanyID schemeID="{{ $debitNote->sale->customer->identificationDocument->id }}" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $debitNote->sale->customer->document }}</cbc:CompanyID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="{{ $debitNote->sale->customer->identificationDocument->id }}" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $debitNote->sale->customer->document }}</cbc:ID>
                </cac:TaxScheme>
            </cac:PartyTaxScheme>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[{{ $debitNote->sale->customer->name }}]]></cbc:RegistrationName>
                <cac:RegistrationAddress>
                    <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI"/>
                    <cbc:CityName><![CDATA[]]></cbc:CityName>
                    <cbc:CountrySubentity><![CDATA[]]></cbc:CountrySubentity>
                    <cbc:District><![CDATA[]]></cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[{{ $debitNote->sale->customer->address }}]]></cbc:Line>
                    </cac:AddressLine>                                        
                    <cac:Country>
                        <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="PEN">{{ round($debitNote->total_igv, 2) }}</cbc:TaxAmount>
        @if($debitNote->total_taxed > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($debitNote->total_taxed, 2) }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">{{ round($debitNote->total_igv, 2) }}</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">S</cbc:ID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">1000</cbc:ID>
                    <cbc:Name>IGV</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        @endif
        @if($debitNote->total_exonerated > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($debitNote->total_exonerated, 2) }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
                    <cbc:Name>EXO</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        @endif
        @if($debitNote->total_unaffected > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($debitNote->total_unaffected, 2) }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">O</cbc:ID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                    <cbc:Name>INA</cbc:Name>
                    <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        @endif
        @if($debitNote->total_free > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($debitNote->total_free, 2) }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
            <cac:TaxCategory>
                <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">Z</cbc:ID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9996</cbc:ID>
                    <cbc:Name>GRA</cbc:Name>
                    <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
        @endif
    </cac:TaxTotal>
    <!-- FALTA ESTO  -->
    <cac:RequestedMonetaryTotal>
        <cbc:TaxInclusiveAmount currencyID="PEN">{{ round($debitNote->total, 2) }}</cbc:TaxInclusiveAmount>
        <cbc:ChargeTotalAmount currencyID="PEN">0.00</cbc:ChargeTotalAmount>
        <cbc:PayableAmount currencyID="PEN">{{ round($debitNote->total, 2) }}</cbc:PayableAmount>
    </cac:RequestedMonetaryTotal>

    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="PEN">{{ round($debitNote->subtotal, 2) }}</cbc:LineExtensionAmount>
        <cbc:TaxInclusiveAmount currencyID="PEN">{{ round($debitNote->total, 2) }}</cbc:TaxInclusiveAmount>
        @if($debitNote->discount > 0)
        <cbc:AllowanceTotalAmount currencyID="PEN">{{ round($debitNote->discount, 2) }}</cbc:AllowanceTotalAmount>
        @endif
        <cbc:ChargeTotalAmount currencyID="PEN">0.00</cbc:ChargeTotalAmount>
        <cbc:PrepaidAmount currencyID="PEN">0.00</cbc:PrepaidAmount>
        <cbc:PayableAmount currencyID="PEN">{{ round($debitNote->total, 2) }}</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    <!-- FALTA ESTO  -->
    @foreach ($debitNote->debitDetails as $i => $debitNoteDetail)
    <cac:DebitNoteLine>
        <cbc:ID>{{ $i+1 }}</cbc:ID>
        <cbc:DebitedQuantity unitCode="NIU" unitCodeListID="UN/ECE rec 20" unitCodeListAgencyName="United Nations Economic Commission for Europe">{{ number_format($debitNoteDetail->quantity, 10, '.', '') }}</cbc:DebitedQuantity>
        <cbc:LineExtensionAmount currencyID="PEN">{{ round($debitNoteDetail->subtotal, 2) }}</cbc:LineExtensionAmount>
        <cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID="PEN">{{ round($debitNoteDetail->price, 2) }}</cbc:PriceAmount>
                <cbc:PriceTypeCode listName="Tipo de Precio" listAgencyName="PE:SUNAT" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="PEN">{{ round($debitNoteDetail->total_igv, 2) }}</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="PEN">{{ round($debitNoteDetail->total, 2) }}</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="PEN">{{ round($debitNoteDetail->total_igv, 2) }}</cbc:TaxAmount>
                @switch($debitNoteDetail->igvType->id)
                @case(10)
                <cac:TaxCategory>
                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">S</cbc:ID>
                    <cbc:Percent>18</cbc:Percent>
                    <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
                @break
                @case(20)
                <cac:TaxCategory>
                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">E</cbc:ID>
                    <cbc:Percent>0</cbc:Percent>
                    <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">20</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9997</cbc:ID>
                        <cbc:Name>EXO</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
                @break
                @case(30)
                <cac:TaxCategory>
                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">O</cbc:ID>
                    <cbc:Percent>0</cbc:Percent>
                    <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">30</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9998</cbc:ID>
                        <cbc:Name>INA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
                @break 
                @default
                <cac:TaxCategory>
                    <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">Z</cbc:ID>
                    <cac:TaxScheme>
                        <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">9996</cbc:ID>
                        <cbc:Name>GRA</cbc:Name>
                        <cbc:TaxTypeCode>FRE</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>     
                @endswitch
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <cac:Item>
            <cbc:Description><![CDATA[{{ $debitNoteDetail->branchProduct->product->name }}]]></cbc:Description>
            @if ($debitNoteDetail->branchProduct->product->cod)
            <cac:SellersItemIdentification>
                <cbc:ID><![CDATA[{{ $debitNoteDetail->branchProduct->product->cod }}]]></cbc:ID>
            </cac:SellersItemIdentification>
            @endif
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="PEN">{{ $debitNoteDetail->price }}</cbc:PriceAmount>
        </cac:Price>
    </cac:DebitNoteLine>
    @endforeach
</DebitNote>