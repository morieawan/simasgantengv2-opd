<script lang="ts">
  import { onMount } from 'svelte';
  import { push } from 'svelte-spa-router';

  let listData: any[] = [];
  let selectedData: any = null;
  let isLoading: boolean = true;
  let errorMessage: string = '';

  async function loadData() {
    isLoading = true;
    errorMessage = '';
    try {
      // Panggil URL API Yii2 yang mengarahkan ke actionGetData()
      const res = await fetch('/simasgantengv2-opd/web/bpjs-peserta/get-data');
      
      if (!res.ok) throw new Error(`HTTP Error: ${res.status}`);

      const result = await res.json();
      if (result.status === 'success' && Array.isArray(result.data)) {
        listData = result.data;
      } else {
        errorMessage = result.message || 'Format data tidak sesuai';
      }
    } catch (err: any) {
      errorMessage = err.message;
    } finally {
      isLoading = false;
    }
  }

  async function handleDelete(id: number) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) return;

    // Ambil token CSRF Yii2 dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const res = await fetch(`/simasgantengv2-opd/web/bpjs/peserta/delete?id=${id}`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken 
      }
    });
    const result = await res.json();
    if (result.status === 'success') {
      loadData();
    }
  }

  onMount(loadData);
</script>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="m-0">Data Laporan Bulanan</h5>
  <button class="btn btn-sm btn-primary" on:click={() => push('/bpjs-peserta/create')}>
    <i class="fas fa-plus"></i> Tambah Bulanan
  </button>
</div>

<div class="card card-outline card-primary p-0">
  <div class="card-body p-0">
    {#if isLoading}
      <div class="text-center py-4">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 text-muted mb-0">Memuat data...</p>
      </div>
    {:else if errorMessage}
      <div class="alert alert-danger m-3">
        <i class="fas fa-exclamation-triangle"></i> {errorMessage}
      </div>
    {:else}
      <table class="table table-bordered table-striped m-0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Bulan</th>
            <th>Total</th>
            <th style="width: 150px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          {#each listData as item (item.id)}
            <tr>
              <td>{item.id}</td>
              <td>{item.bulan}</td>
              <td>{item.total}</td>
              <td>
                <button class="btn btn-xs btn-info" title="Lihat Detail" aria-label="Lihat Detail" on:click={() => selectedData = item}>
                  <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-xs btn-warning" title="Edit Data" aria-label="Edit Data" on:click={() => push(`/bpjs-peserta/edit/${item.id}`)}>
                  <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-xs btn-danger" title="Hapus Data" aria-label="Hapus Data" on:click={() => handleDelete(item.id)}>
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          {:else}
            <tr>
              <td colspan="4" class="text-center text-muted py-3">Tidak ada data ditemukan</td>
            </tr>
          {/each}
        </tbody>
      </table>
    {/if}
  </div>
</div>

<!-- Modal Detail View -->
{#if selectedData}
  <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Laporan #{selectedData.id}</h5>
          <button type="button" class="close" title="Tutup Modal" aria-label="Tutup Modal" on:click={() => selectedData = null}>&times;</button>
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