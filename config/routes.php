<?php

return [
    'login'=>'site/login',
    ''=>'site/index',
    ''=>'site',
    'data-asn-pd' => '/sitampan/preskin-asn/index',
    'jadwal-pd' => '/sitampan/pres-harian/jadwal-opd',
    'presensi' => '/sitampan/pres-harian-user/index',
    'presensi-pd' => '/sitampan/pres-harian/pres-opd',
    'target-kinerja' => '/sitampan/kin-harian/target',
    'realisasi-kinerja' => '/sitampan/kin-harian/realisasi',
    'penilaian-bawahan' => '/sitampan/kin-harian/penilaian',
    'kinerja-bawahan' => '/sitampan/kin-harian/kinerja-bawahan',
    'ket-absen' => '/sitampan/pres-ket/index',
    'penerima-tpp' => '/sitampan/preskin-tpp-hitung/penerima-tpp',
    'cetak-tpp' => '/sitampan/preskin-tpp-hitung/cetak-form-pdf',
    'tppcetak' => '/sitampan/preskin-tpp-hitung/cetak-tpp',
    'tpp-final-perbendaharaan' => '/sitampan/preskin-tpp-hitung-bpkad/cetak-form',
    'coretax-perbendaharaan' => '/sitampan/preskin-coretax-bpkad/search',
    'coretax-akhir-perbendaharaan' => '/sitampan/preskin-coretax-akhir-bpkad/search',
    'coretax-akhir-perbendaharaan-cetak' => '/sitampan/preskin-coretax-akhir-bpkad/cetak',

    'data-asn-upt' => '/sitampan/upt/index',
    'presensi-upt' => '/sitampan/upt/presensi',
    'kinerja-upt' => '/sitampan/upt/kinerja',
    'penerima-tpp-upt' => '/sitampan/upt/penerima-tpp',
    'cetak-tpp-upt' => '/sitampan/upt/cetak-tpp-form',
    'coretax-search' => '/sitampan/preskin-coretax-tpp/search',
    'coretax' => '/sitampan/preskin-coretax-tpp/index',

    'kinerja' => '/sitampan/kin-harian/search',
    'kinerja-asn' => '/sitampan/kin-harian/index',
    'kinerja-detail' => '/sitampan/kin-harian/detail',

    'asn-wfh' => '/sitampan/preskin-wfh/search',
    'data-asn-wfh' => '/sitampan/preskin-wfh/index',
    'delete-tgl' => '/sitampan/preskin-wfh/delete-tgl',
    'hasil-wfh' => '/sitampan/preskin-wfh/hasil',
    'rekap-wfh' => '/sitampan/preskin-wfh/rekap',

    'coretax-akhir-search' => '/sitampan/preskin-coretax-akhir/search',
    'coretax-akhir' => '/sitampan/preskin-coretax-akhir/index',
    'coretax-akhir-excel' => '/sitampan/preskin-coretax-akhir/export-excel',
    'coretax-akhir-cetak' => '/sitampan/preskin-coretax-akhir/cetak',

    'anomali' => '/integrasi/siasn-anomali/index',
    'data-asn-opd' => '/integrasi/kepegawaian/index',
    'data-view' => '/integrasi/kepegawaian/view',
    'data-profil' => '/integrasi/kepegawaian/profil',

    'bpjs-keluarga' => 'bpjs/default/index',

    'bpjs-peserta' => 'bpjs/peserta/index',
    'bpjs-peserta/<action:\w+>' => 'bpjs/peserta/<action>',
    
    'bpjs-iuran' => 'bpjs/iuran/index',
    'bpjs-iuran/<action:\w+>' => 'bpjs/iuran/<action>',

    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ['class' => 'app\config\UrlRule', 'connectionID' => 'db'],
];
