<script lang="ts">
  import Router, { push } from 'svelte-spa-router';
  import active from 'svelte-spa-router/active'; // Gunakan directive active untuk navigasi tab
  import PesertaIndex from './pages/peserta/Index.svelte';
  import PesertaForm from './pages/peserta/Form.svelte';
  import IuranIndex from './pages/iuran/Index.svelte';

  const routes = {
    '/bpjs-peserta': PesertaIndex,
    '/bpjs-peserta/create': PesertaForm,
    '/bpjs-peserta/edit/:id': PesertaForm,
    '/bpjs-iuran': IuranIndex,
    '*': PesertaIndex
  };
</script>

<div class="card card-primary card-outline card-tabs">
  <div class="card-header p-0 pt-1 border-bottom-0">
    <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
      <li class="nav-item">
        <!-- Gunakan use:active agar kelas 'active' otomatis ditambahkan jika URL cocok -->
        <a class="nav-link" href="#/bpjs-peserta" use:active>
          Peserta
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#/bpjs-iuran" use:active>
          Iuran BPJS
        </a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <Router {routes} />
  </div>
</div>