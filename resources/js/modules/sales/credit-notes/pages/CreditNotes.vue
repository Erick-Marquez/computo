<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Notas de crédito</h1>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <a href="/nueva-nota-de-credito" class="btn btn-lg btn-block btn-dark mb-4">
          <i class="fas fa-plus"></i>
          Nueva Nota de crédito
        </a>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de notas de crédito</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Comprobante</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th class="text-center">PDF</th>
                    <th class="text-center">XML</th>
                    <th class="text-center">CDR</th>
                    <th class="text-center">Sunat</th>
                    <!-- <th class="text-center">Acciones</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="creditNote in creditNotes" :key="creditNote.id">
                    <td class="align-middle">
                      {{ getTimestamp(creditNote.created_at) }}
                    </td>
                    <td class="align-middle">
                      <span class="text-muted">NOTA CREDITO: </span>
                      {{ creditNote.serie.serie }}-{{ creditNote.document_number }}
                      <br />
                      <span class="badge bg-maroon">Afecta:</span>
                      {{ creditNote.sale.serie.serie }} -
                      {{ creditNote.sale.document_number }}
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{
                        (creditNote.sale.customer.identification_document_id = 6
                          ? "RUC:"
                          : "DNI:")
                      }}</span>
                      {{ creditNote.sale.customer.document }}
                      <br />
                      <span class="badge bg-maroon">Nombre:</span>
                      {{ creditNote.sale.customer.name }}
                    </td>
                    <td class="align-middle">S/. {{ creditNote.total }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Visualizar el PDF" target="_blank" :href="'print/credit-notes/A4/' + creditNote.id">
                        <img src="../../../../../img/pdf_cpe.svg" style="width: 30px">
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      <a
                        title="Haz Click para Descargar el XML"
                        target="_blank"
                        href="#"
                        ><img
                          src="../../../../../img/xml_cpe.svg"
                          style="width: 30px"
                      /></a>
                    </td>
                    <td class="align-middle text-center">
                      <a
                        title="Haz Click para Descargar el CDR"
                        target="_blank"
                        href="#"
                        ><img
                          src="../../../../../img/xml_cdr.svg"
                          style="width: 30px"
                      /></a>
                    </td>
                    <td class="align-middle text-center">
                      <i
                        v-if="creditNote.state == 'ACEPTADO'"
                        class="text-success fas fa-check"
                      ></i>
                      <i
                        v-else-if="creditNote.state == 'RECHAZADO'"
                        class="text-danger fas fa-ban"
                      ></i>
                      <i
                        v-else-if="creditNote.state == 'PENDIENTE'"
                        class="text-success fas fa-sync-alt"
                      ></i>
                      <i
                        v-else-if="creditNote.state == 'ANULADO'"
                        class="text-danger fas fa-window-close"
                      ></i>
                    </td>
                    <!-- <td class="align-middle text-center">
                      <div class="dropdown">
                        <button
                          class="btn btn-danger dropdown-toggle"
                          type="button"
                          id="dropdownMenuButton"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          Acciones
                        </button>
                        <div
                          class="dropdown-menu"
                          aria-labelledby="dropdownMenuButton"
                          style=""
                        >
                          <a
                            class="dropdown-item"
                            href="#"
                            @click="getTicketStatus(creditNote)"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Consultar estado de ticket</a
                          >
                        </div>
                      </div>
                    </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <ul class="pagination pagination-sm m-0 float-right">
              <li v-for="(link, index) in meta.links" :key="link.index"
              :class="link.url == null ? 'page-item disabled' : link.active ? 'page-item active' : 'page-item'">
                <button type="button"
                  class="page-link"
                  @click="(link.url == null || link.active) ? null : showPaginateCreditNotes(link.url)"
                >
                  {{ index == 0 ? 'Anterior' : index == meta.links.length - 1 ? 'Siguiente' : link.label }}
                </button>
              </li>
            </ul>
          </div>

        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl.js";
export default {
  components: { BaseUrl },
  async created() {
    this.getCreditNotes();
  },
  data() {
    return {

      meta: {},
      perPage: 10,

      creditNotes: [],
    };
  },
  methods: {
    async getCreditNotes() {
      await BaseUrl.get(`api/credit-notes?page=1&perPage=${this.perPage}`).then((resp) => {
        this.creditNotes = resp.data.data
        this.meta = resp.data.meta
      });
    },
    async showPaginateCreditNotes(url){
      await axios.get(`${url}&perPage=${this.perPage}`)
      .then( resp => {
        this.creditNotes = resp.data.data
        this.meta = resp.data.meta
      })
    },
    getTimestamp(date) {
      let dateString = new Date(Date.parse(date)).toLocaleString("en-US", {
        timeZone: "America/Lima",
      });
      return dateString;
    }
  },
};
</script>

<style>
</style>
