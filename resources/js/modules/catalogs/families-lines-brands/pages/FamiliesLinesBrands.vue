<template>
  <div class="content-header">
    <div class="container-fluid">

    </div>
  </div>

  <div class="container-fluid">
    <div class="card card-danger card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-family-tab" data-toggle="pill" href="#custom-tabs-families" role="tab" aria-controls="custom-tabs-families" aria-selected="true"><h4>Familias</h4></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-line-tab" data-toggle="pill" href="#custom-tabs-lines" role="tab" aria-controls="custom-tabs-lines" aria-selected="false"><h4>Lineas</h4></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-brand-tab" data-toggle="pill" href="#custom-tabs-brands" role="tab" aria-controls="custom-tabs-brands" aria-selected="false"><h4>Marcas</h4></a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
          
          <!-- Families -->
          <div class="tab-pane fade active show" id="custom-tabs-families" role="tabpanel" aria-labelledby="custom-tabs-families-tab">

            <Families/>

          </div>
          <!-- /.Families -->

          <!-- Lines -->
          <div class="tab-pane fade" id="custom-tabs-lines" role="tabpanel" aria-labelledby="custom-tabs-lines-tab">

            <Lines/>

          </div>
          <!-- /.Lines -->

          <!-- Brands -->
          <div class="tab-pane fade" id="custom-tabs-brands" role="tabpanel" aria-labelledby="custom-tabs-brands-tab">

            <Brands/>

          </div>
          <!-- /.Brands -->
        </div>
      </div>
  </div>
  </div>
  
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
import Families from "../components/Families.vue"
import Lines from "../components/Lines.vue"
import Brands from "../components/Brands.vue"
export default {
  components:{ BaseUrl, Families, Lines, Brands },

  data(){
    return{
      
    }
  },
  methods:{
    
  }
}
</script>

<style>
</style>
