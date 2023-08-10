<?php 
    function getJenisAduan($id)
    {
        $jenisModel = new \App\Models\JenisModel();
        return $jenisModel->find($id);
    }

    function getStatusAduan($id)
    {
        $statusModel = new \App\Models\StatusModel();
        return $statusModel->find($id);
    }

    // month to roman
    function bulanRomawi($bulan)
    {
        $bulan = ltrim($bulan, '0');
        $romawi = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        );
        return $romawi[$bulan];
    }

    // bulan indonesia
    function bulanIndonesia($bulan)
    {
        $bulan = ltrim($bulan, '0');
        $romawi = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );
        return $romawi[$bulan];
    }