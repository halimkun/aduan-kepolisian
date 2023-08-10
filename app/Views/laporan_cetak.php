<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <title>
        Laporan Aduan tahu <?= $tahun ?> <?= $bulan !== '' ? "bulan " . $bulan : '' ?>
    </title>

    <style>
        @page {
            size: A4
        }

        html {
            font-family: Arial, Helvetica, sans-serif;
            color: #094471;
            text-align: justify;
        }

        .logo-kab {
            width: 100px;
            left: 0;
        }

        .judul_surat {
            text-transform: uppercase;
        }

        #kop_surat {
            padding: 1em;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .paragraph {
            padding-bottom: 10px;
        }

        .ttd {
            margin-top: .5em;
            margin-right: 2.5em;
        }

        .sheet.padding-y-0mm {
            padding-top: 0mm !important;
            padding-bottom: 0mm !important;
        }

        .sheet.padding-x-15mm {
            padding-left: 15mm !important;
            padding-right: 15mm !important;
        }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<?php
$nomorSurat = "B/" . rand(1111, 9999) . "/" . bulanRomawi(date('m')) . "/PAM." . date('d') . "." . date("m") . "/" . date('Y');

// hitung kenaikan atau penurunan aduan bulan ini dengan aduan bulan lalu
$naikTurun = count($aduan) - count($aduanBulanLalu);
$naikTurun = $naikTurun > 0 ? "kenaikan" : "penurunan";

// persentase naik turun
$persentase = round(abs(count($aduan) / count($aduanBulanLalu)) * 100, 2);
?>

<body class="">
    <section class="sheet padding-10mm">
        <div class="text-center">
            <img src="https://3.bp.blogspot.com/-vDSE3yUUHJs/VtVFn0qZOkI/AAAAAAAAA2E/EqICaTGQ5nE/s1600/Logo%2BPOLRI%2B-%2BKepolisian%2BRepublik%2BIndonesia%2BBW.jpg" class="" style="width: 100px;" alt="main_logo">
        </div>
        <div class="text-center mb-4 mt-3">
            <h5 class="judul_surat m-0"><b>KEPOLISIAN NEGARA REPUBLIK INDONESIA</b></h5>
            <h5 class="judul_surat m-0"><b>DAERAH JAWA TENGAH</b></h5>
            <h5 class="judul_surat m-0"><b>RESOR PEKALONGAN</b></h5>
            <h5 class="judul_surat m-0"><b>SEKTOR BOJONG</b></h5>
            <p><u>Kedoyo, Bojong Minggir, Kec. Bojong, Kabupaten Pekalongan, Jawa Tengah 51156</u></p>
        </div>

        <div class="text-left mb-4">
            <table class="borderless table-compact">
                <tr>
                    <td width="100px">Nomor</td>
                    <td width="15px">:</td>
                    <td><?= $nomorSurat ?></td>
                </tr>
                <tr>
                    <td>Klasifikasi</td>
                    <td>:</td>
                    <td>BIASA</td>
                </tr>
                <tr>
                    <td>Perihal</td>
                    <td>:</td>
                    <td>Rekap Laporan Aduan</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>1 Bandel</td>
                </tr>
            </table>
        </div>

        <div class="isi_surat">
            <p class="paragraph mb-2">
                <span class="tab">Dengan hormat,</span><br>
                <span class="tab ms-5">Sehubungan dengan surat perintah Kapolres Pekalongan Nomor : <?= $nomorSurat ?> tanggal <?= date('j F Y') ?> tentang Laporan Aduan, maka dengan ini kami sampaikan laporan aduan pada <b><?= $bulan !== '' ? bulanIndonesia($bulan) : '' ?> tahun <?= $tahun ?> </b> sebagai berikut :</span>
            </p>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-borderless">
                        <tr>
                            <td style="width:45%;">Jumlah Aduan</td>
                            <td>:</td>
                            <td><?= count($aduan) ?></td>
                        </tr>
                        <!-- aduan yang di selesaikan -->
                        <tr>
                            <td>Jumlah Aduan yang diselesaikan</td>
                            <td>:</td>
                            <td><?= count($aduanSelesai) ?></td>
                        </tr>
                        <!-- aduan dalam proses -->
                        <tr>
                            <td>Jumlah Aduan yang dalam proses</td>
                            <td>:</td>
                            <td><?= count($aduanProses) ?></td>
                        </tr>
                        <!-- aduan lainnya -->
                        <tr>
                            <td>Jumlah Aduan lainnya</td>
                            <td>:</td>
                            <td><?= count($aduanLainnya) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <p class="paragraph mb-2">
                <span class="ms-5">Dari laporan aduan tersebut diatas, jumlah aduan pada <?= $bulan !== '' ? 'bulan ' . bulanIndonesia($bulan) : '' ?> tahun <?= $tahun ?> mengalami <?= $naikTurun ?> sebanyak <?= $persentase ?>% dari bulan sebelumnya. Hal ini menunjukkan bahwa kinerja kami dalam menangani aduan masyarakat <?= $naikTurun == 'penurunan' ? 'menurun' : 'meningkat' ?>. Dengan demikian, kami akan terus meningkatkan kinerja kami dalam menangani aduan masyarakat.</span>
            </p>

            <p class="paragraph mb-2">
                <span class="ms-5">
                    Demikian laporan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
                </span>
            </p>
        </div>
        <div class="ttd d-flex flex-column align-items-end">
            <div class="text-center">
                <p>
                    Pekalongan, <?= date('j F Y') ?><br>
                    Kepala Kepolisian Sektor Bojong
                </p>

                <p style="margin-top: 100px;"><strong>AKP SUHADI, S.H</strong></p>
            </div>
        </div>
    </section>
    
    <section class="sheet padding-10mm">
        <div class="text-center">
            <img src="https://3.bp.blogspot.com/-vDSE3yUUHJs/VtVFn0qZOkI/AAAAAAAAA2E/EqICaTGQ5nE/s1600/Logo%2BPOLRI%2B-%2BKepolisian%2BRepublik%2BIndonesia%2BBW.jpg" class="" style="width: 80px;" alt="main_logo">
        </div>
        <div class="text-center mb-4 mt-3">
            <h6 class="judul_surat m-0"><b>KEPOLISIAN NEGARA REPUBLIK INDONESIA</b></h6>
            <h6 class="judul_surat m-0"><b>DAERAH JAWA TENGAH</b></h6>
            <h6 class="judul_surat m-0"><b>RESOR PEKALONGAN</b></h6>
            <h6 class="judul_surat m-0"><b>SEKTOR BOJONG</b></h6>
            <p><u>Kedoyo, Bojong Minggir, Kec. Bojong, Kabupaten Pekalongan, Jawa Tengah 51156</u></p>
        </div>

        <div class="text-center">
            <div class="judul_surat">
                <h6><b>LAMPIRAN ADUAN MASUK</b></h6>
            </div>
        </div>

        <table class="text-left table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No. Aduan</th>
                    <th>Jenis</th>
                    <th>Pelapor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($aduan as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d M Y H:i', strtotime($row->tanggal)) ?></td>
                        <td><?= $row->nomor ?></td>
                        <td><?= $row->jenis_aduan ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->status_aduan ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>

    <script>
        window.print();
    </script>

</body>

</html>