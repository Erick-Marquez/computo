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