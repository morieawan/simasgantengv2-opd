<script lang="ts">
  import { onMount } from 'svelte';
  import { push } from 'svelte-spa-router'; // Hanya import push

  // Deklarasi prop params untuk menangkap ID dari URL (contoh: /edit/:id)
  export let params: { id?: string } = {};

  let formData = {
    bulan: '',
    total: 0
  };
  let isEdit = false;

  onMount(async () => {
    if (params && params.id) {
      isEdit = true;
      const res = await fetch(`/simasgantengv2-opd/web/bpjs/peserta/view?id=${params.id}`);
      const result = await res.json();
      if (result.status === 'success') {
        formData = result.data;
      }
    }
  });

  async function handleSubmit() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const url = isEdit 
      ? `/simasgantengv2-opd/web/bpjs/peserta/update?id=${params.id}` 
      : '/simasgantengv2-opd/web/bpjs/peserta/create';

    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-Token': csrfToken
      },
      body: JSON.stringify(formData)
    });

    const result = await res.json();
    if (result.status === 'success') {
      push('/bpjs-peserta');
    }
  }
</script>