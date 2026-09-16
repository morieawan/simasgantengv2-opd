const flashdata = $('.flash-data').data('flashdata');
const errordata = $('.error-data').data('errordata');

if(flashdata) {
    Swal.fire({
        icon: 'success',
        title: 'Data Berhasil ' + flashdata,
        text: '',
        timer : 900,
        customClass: 'swal-wide', // agar bisa saya edit ukuran popupnya
      })
}

if(errordata) {
    Swal.fire({
        icon: 'error',
        title: 'Data gagal disimpan',
        text: errordata,
        //timer : 900,
        customClass: 'swal-wide', // agar bisa saya edit ukuran popupnya
      })
}
// Ketika Dihapus
$(".tombol-hapus").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Anda akan menghapus data ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus data',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});

$(".tombol-konfirm").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Menyetujui realisasi kinerja ini',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00a65a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Setuju',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});

$(".tombol-batal").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Membatalkan realisasi kinerja ini',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Batalkan',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});

$('.tombol-logout').click(function(e){
    console.log = e;
    e.preventDefault(); 
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin?',
        icon: 'question',
		text: 'Anda akan keluar aplikasi ini',
        //showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Tidak',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        closeOnConfirm: true,
        closeOnCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        } 
    });
});

$(".tombol-reset").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Anda akan mereset username dan password',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Reset',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});

$(".reset-device").click(function(e) {
    console.log = e;
    e.preventDefault(); // untuk menghentikan href
    e.stopImmediatePropagation();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: 'Anda akan menghapus data',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        customClass: 'swal-wide',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(href);
        }
    })
});