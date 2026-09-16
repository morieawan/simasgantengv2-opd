<script lang="ts">
  import { onMount } from 'svelte';
  import { push } from 'svelte-spa-router';

  let listData: any[] = [];
  let selectedData: any = null; // Untuk Modal View

  async function loadData() {
    const res = await fetch('/bpjs-peserta/index');
    const result = await res.json();
    listData = result.data;
  }

  async function handleDelete(id: number) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

    const res = await fetch(`/bpjs-peserta/delete&id=${id}`, {
      method: 'POST',
      headers: { 'X-CSRF-Token': yii.getCsrfToken() }
    });
    const result = await res.json();
    if (result.status === 'success') {
      loadData(); // Refresh list
    }
  }

  onMount(loadData);
</script>

<div class="d-flex justify-content-between mb-3">
  <h5>Data Laporan Bulanan</h5>
  <button class="btn btn-sm btn-primary" on:click={() => push('/bpjs-peserta/create')}>
    <i class="fas fa-plus"></i> Tambah Bulanan
  </button>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Bulan</th>
      <th>Total</th>
      <th style="width: 150px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    {#each listData as item}
      <tr>
        <td>{item.id}</td>
        <td>{item.bulan}</td>
        <td>{item.total}</td>
        <td>
          <!-- VIEW (Bisa via Modal) -->
          <button class="btn btn-xs btn-info" title="Lihat Detail" aria-label="Lihat Detail" on:click={() => selectedData = item}>
            <i class="fas fa-eye"></i>
          </button>

          <!-- UPDATE -->
          <button class="btn btn-xs btn-warning" title="Edit Data" aria-label="Edit Data" on:click={() => push(`/bpjs-peserta/edit/${item.id}`)}>
            <i class="fas fa-edit"></i>
          </button>

          <!-- DELETE -->
          <button class="btn btn-xs btn-danger" title="Hapus Data" aria-label="Hapus Data" on:click={() => handleDelete(item.id)}>
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    {/each}
  </tbody>
</table>

<!-- Modal Detail View -->
{#if selectedData}
  <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Laporan #{selectedData.id}</h5>
          <button type="button" class="close" on:click={() => selectedData = null}>&times;</button>
        </div>
        <div class="modal-body">
          <p><strong>Bulan:</strong> {selectedData.bulan}</p>
          <p><strong>Total:</strong> {selectedData.total}</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" on:click={() => selectedData = null}>Tutup</button>
        </div>
      </div>
    </div>
  </div>
{/if}