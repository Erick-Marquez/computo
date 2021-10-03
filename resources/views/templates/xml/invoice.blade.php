{!! '<?xml version="1.0" encoding="utf-8" standalone="no"?>' !!}
<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
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
    <cbc:CustomizationID schemeAgencyName="PE:SUNAT">2.0</cbc:CustomizationID>
    <cbc:ProfileID schemeName="Tipo de Operacion" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51">0101</cbc:ProfileID>
    <cbc:ID>{{ $sale->serie->serie }}-{{ $sale->document_number }}</cbc:ID>
    <cbc:IssueDate>{{ $sale->date_issue }}</cbc:IssueDate>
    <cbc:IssueTime>00:00:00</cbc:IssueTime>
    <cbc:DueDate>{{ $sale->date_due }}</cbc:DueDate>
    <cbc:InvoiceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01" listID="0101" name="Tipo de Operacion" listSchemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51">{{ $sale->serie->voucherType->cod }}</cbc:InvoiceTypeCode>
    <cbc:Note languageLocaleID="1000">SON SESENTA  CON 00/100</cbc:Note>
    <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listName="Currency" listAgencyName="United Nations Economic Commission for Europe">PEN</cbc:DocumentCurrencyCode>
    <cbc:LineCountNumeric>{{ count($sale->saleDetails) }}</cbc:LineCountNumeric>
    <cac:Signature>
        <cbc:ID>{{ $sale->serie->serie }}-{{ $sale->document_number }}</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>{{ $company->ruc }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name>{{ $company->comercial_name }}</cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#{{ $sale->serie->serie }}-{{ $sale->document_number }}</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
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
                <cbc:ID schemeID="{{ $sale->customer->identificationDocument->cod }}" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $sale->customer->document }}</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[{{ $sale->customer->name }}]]></cbc:Name>
            </cac:PartyName>
            <cac:PartyTaxScheme>
                <cbc:RegistrationName><![CDATA[{{ $sale->customer->name }}]]></cbc:RegistrationName>
                <cbc:CompanyID schemeID="{{ $sale->customer->identificationDocument->cod }}" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $sale->customer->document }}</cbc:CompanyID>
                <cac:TaxScheme>
                    <cbc:ID schemeID="{{ $sale->customer->identificationDocument->cod }}" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">{{ $sale->customer->document }}</cbc:ID>
                </cac:TaxScheme>
            </cac:PartyTaxScheme>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[{{ $sale->customer->name }}]]></cbc:RegistrationName>
                <cac:RegistrationAddress>
                    <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI"/>
                    <cbc:CityName><![CDATA[]]></cbc:CityName>
                    <cbc:CountrySubentity><![CDATA[]]></cbc:CountrySubentity>
                    <cbc:District><![CDATA[]]></cbc:District>
                    <cac:AddressLine>
                        <cbc:Line><![CDATA[{{ $sale->customer->address }}]]></cbc:Line>
                    </cac:AddressLine>                                        
                    <cac:Country>
                        <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE</cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    <cac:PaymentTerms>
        <cbc:ID>FormaPago</cbc:ID>
        <cbc:PaymentMeansID>Contado</cbc:PaymentMeansID>
    </cac:PaymentTerms>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="PEN">{{ round($sale->total_igv, 2) }}</cbc:TaxAmount>
        @if($sale->total_taxed > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($sale->total_taxed, 2) }}</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">{{ round($sale->total_igv, 2) }}</cbc:TaxAmount>
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
        @if($sale->total_exonerated > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($sale->total_exonerated, 2) }}</cbc:TaxableAmount>
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
        @if($sale->total_unaffected > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($sale->total_unaffected, 2) }}</cbc:TaxableAmount>
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
        @if($sale->total_free > 0)
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">{{ round($sale->total_free, 2) }}</cbc:TaxableAmount>
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
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="PEN">{{ round($sale->subtotal, 2) }}</cbc:LineExtensionAmount>
        <cbc:TaxInclusiveAmount currencyID="PEN">{{ round($sale->total, 2) }}</cbc:TaxInclusiveAmount>
        @if($sale->discount > 0)
        <cbc:AllowanceTotalAmount currencyID="PEN">{{ round($sale->discount, 2) }}</cbc:AllowanceTotalAmount>
        @endif
        <cbc:ChargeTotalAmount currencyID="PEN">0.00</cbc:ChargeTotalAmount>
        <cbc:PayableAmount currencyID="PEN">{{ round($sale->total, 2) }}</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    @foreach ($sale->saleDetails as $i => $saleDetail)
    <cac:InvoiceLine>
        <cbc:ID>{{ $i+1 }}</cbc:ID>
        <cbc:InvoicedQuantity unitCode="NIU" unitCodeListID="UN/ECE rec 20" unitCodeListAgencyName="United Nations Economic Commission for Europe">{{ number_format($saleDetail->quantity, 10, '.', '') }}</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID="PEN">{{ round($saleDetail->subtotal, 2) }}</cbc:LineExtensionAmount>
        <cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID="PEN">{{ round($saleDetail->price, 2) }}</cbc:PriceAmount>
                <cbc:PriceTypeCode listName="Tipo de Precio" listAgencyName="PE:SUNAT" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="PEN">{{ round($saleDetail->total_igv, 2) }}</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="PEN">{{ round($saleDetail->total, 2) }}</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="PEN">{{ round($saleDetail->total_igv, 2) }}</cbc:TaxAmount>
                @switch($saleDetail->igvType->cod)
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
            <cbc:Description><![CDATA[{{ $saleDetail->branchProduct->product->name }}]]></cbc:Description>
            @if ($saleDetail->branchProduct->product->cod)
            <cac:SellersItemIdentification>
                <cbc:ID><![CDATA[{{ $saleDetail->branchProduct->product->cod }}]]></cbc:ID>
            </cac:SellersItemIdentification>
            @endif
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="PEN">{{ $saleDetail->price }}</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>
    @endforeach
</Invoice>