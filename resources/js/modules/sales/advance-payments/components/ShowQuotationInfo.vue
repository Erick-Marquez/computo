<template>
    <div class="table-responsive">
        <table class="table table-bordered" style="min-width: 600px;">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col" colspan="2" class="w-50">Cliente</th>
                    <th scope="col" colspan="2" class="w-50">Cotización</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Nombre: </th>
                    <td>{{ quotation.customer.name }}</td>
                    <th scope="row">Nº Cotizacion: </th>
                    <td>{{ quotation.serie.serie }} - {{ quotation.document_number }}</td>
                </tr>
                <tr>
                    <th scope="row">Documento: </th>
                    <td>{{ quotation.customer.document }}</td>
                    <th scope="row">Total Cotización: </th>
                    <td>S/. {{ quotation.total - quotation.total_discount }}</td>
                </tr>
                <tr>
                    <th scope="col" colspan="4" class="table-head-center">Detalle de la Cotización</th>
                </tr>
                <tr>
                    <th scope="col" class="table-head-center">Producto</th>
                    <th scope="col" class="table-head-center">Cantidad</th>
                    <th scope="col" class="table-head-center">Valor unitario</th>
                    <th scope="col" class="table-head-center">Total</th>
                </tr>
                <tr v-for="detail in quotation.quotation_details" :key="detail.id">
                    <td>{{ detail.branch_product.product.slug }}</td>
                    <td class="text-center">{{ detail.quantity }}</td>
                    <td class="text-center">S/. {{ detail.unit_value }}</td>
                    <td class="text-center">S/. {{ detail.total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
  props: {
    quotation: Object
  },
  methods: {

  },
};
</script>

<style scoped>
.table-head-center{
   color: #fff;
   background-color: #212529;
   border-color: #383f45;
   text-align: center!important; 
}
</style>