<script lang="ts">
  import Router, { push } from 'svelte-spa-router';
  import PesertaIndex from './pages/peserta/Index.svelte';
  import PesertaForm from './pages/peserta/Form.svelte';
  import IuranIndex from './pages/iuran/Index.svelte';

  const routes = {
    '/bpjs-peserta': PesertaIndex,
    '/bpjs-peserta/create': PesertaForm,
    '/bpjs-peserta/edit/:id': PesertaForm,
    '/bpjs-iuran': IuranIndex,
    '*': PesertaIndex // Default route
  };
</script>

<div class="card card-primary card-outline card-tabs">
  <div class="card-header p-0 pt-1 border-bottom-0">
    <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" href="#/bpjs-peserta">Peserta</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#/bpjs-iuran">Iuran BPJS</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <!-- Komponen view aktif dirender di sini -->
    <Router {routes} />
  </div>
</div>