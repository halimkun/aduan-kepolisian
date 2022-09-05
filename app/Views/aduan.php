<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Aduan</h1>
    </div>

    <?= $this->include('Components/flash_message'); ?>

    <div class="section-body">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4>Daftar Aduan</h4>
                <div class="card-header-action">
                    <button class="btn btn-sm btn-icon btn-primary shadow-sm" data-toggle="modal" data-target="#tambahAduan">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="tableAduan">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th></th>
                            <th>Pelapor</th>
                            <th>Nomor Aduan</th>
                            <th>Aduan</th>
                            <th>Keterangan</th>
                            <th><i class="fa fa-cog"></i></th>
                            <th class="d-none"></th>
                            <th class="d-none"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($aduan as $item) : ?>
                            <tr>
                                <td id="row_nomor"><?= $i++ ?></td>
                                <td id="row_status"><?= badgeStatusGen($item->status) ?></td>
                                <td id="row_pelapor"><?= getUserName($item->user_id) ?></td>
                                <td id="row_nomor"><kbd><?= $item->nomor ?></kbd></td>
                                <td id="row_judul"><?= $item->judul ?></td>
                                <td id="row_keterangan"><?= $item->keterangan ?></td>
                                <td>
                                    <button class="btn btn-update-status btn-sm btn-icon btn-primary shadow-sm" data-item="<?= $item->id ?>" title="Update Status Aduan">
                                        <i class="fas fa-tag"></i>
                                    </button>
                                </td>
                                <td class="d-none"><?= $item->user_id ?></td>
                                <td class="d-none"><?= $item->id ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>

<?= $this->section('topLibrary'); ?>
<!-- CSS Libraies -->
<link rel="stylesheet" href="<?= base_url('assets/modules/select2/dist/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/datatables.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<script>
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
</script>

<?= $this->include('/Components/modal/tambah_aduan'); ?>
<?= $this->include('/Components/modal/detail_aduan'); ?>

<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        var table = $('#tableAduan').DataTable();
        const modalDetail = $("#detailAduan");
        async function getAduanData(a){return await $.ajax({url:"<?= base_url('/aduan/getById') ?>",type:"POST",data:{id:a},dataType:"JSON"})}async function getUserData(a){return await $.ajax({url:"<?= base_url('/user/getById') ?>",type:"POST",data:{id:a},dataType:"JSON"})}

        $('#tableAduan tbody').on('click', 'tr td#row_nomor, tr td#row_status, tr td#row_pelapor, tr td#row_nomor, tr td#row_judul, tr td#row_keterangan', function() {
            modalDetail.modal('toggle')
            $(".load_data_detail").show();
            modalDetail.find(".dLaporan").empty(); modalDetail.find(".dPelapor").empty(); modalDetail.find(".judulLaporan").empty()
            
            setTimeout(async () => {
                var data = table.row(this).data();
                const user = await getUserData(data[7]);
                const res = await getAduanData(data[8]);

                modalDetail.find(".judulLaporan").append(data[4] + " ( " + data[3] + " ) ");

                const detailPelapor = `
                    <div class="mb-3"> <h5>Detail Pelapor</h5><div class="dropdown-divider"></div><table style="width:100% !important;"> <tr> <td style="width:40%;"><b>Nama</b></td><td style="width:30px;">:</td><td>${user.data.nama}</td></tr><tr> <td style="width:40%;"><b>Tanggal Lahir</b></td><td style="width:30px;">:</td><td>${user.data.tanggal_lahir}</td></tr><tr> <td style="width:40%;"><b>Pekerjaan</b></td><td style="width:30px;">:</td><td>${user.data.pekerjaan}</td></tr></table> </div>
                `;
                const detailLaporan = `
                    <div class="mb-3"> <h5>Detail Laporan</h5><div class="dropdown-divider"></div><table style="width:100% !important;"> <tr> <td style="width:40%;"><b>Nomor</b></td><td style="width:30px;">:</td><td>${res.data.nomor}</td></tr><tr> <td style="width:40%;"><b>Status</b></td><td style="width:30px;">:</td><td>${res.data.status}</td></tr><tr> <td style="width:40%;"><b>Tanggal Diajukan</b></td><td style="width:30px;">:</td><td>${res.data.tanggal}</td></tr><tr> <td style="width:40%;"><b>Jenis</b></td><td style="width:30px;">:</td><td>${res.data.jenis}</td></tr><tr> <td style="width:40%;"><b>Judul</b></td><td style="width:30px;">:</td><td>${res.data.judul}</td></tr><tr> <td style="width:40%;"><b>Lokasi</b></td><td style="width:30px;">:</td><td>${res.data.lokasi}</td></tr><tr> <td style="width:40%;"><b>Keterangan</b></td><td style="width:30px;">:</td><td>${res.data.keterangan}</td></tr></table> </div>
                `;
                
                modalDetail.find(".dLaporan").append(detailLaporan);
                modalDetail.find(".dPelapor").append(detailPelapor);

                $(".load_data_detail").hide();
            }, 1000);
        });

        $('.user_select').on('change', async function() {
            var id = $(this).val();
            $(".load_user_input").show();
            if (id == '-') {
                $("#tambahAduan #pekerjaan").val('');
                $("#tambahAduan #jenis_kelamin").val('');
                $("#tambahAduan #tanggal_lahir").val('');
                $("#tambahAduan #alamat").val('');
                $(".load_user_input").hide();
            } else {
                const user = await getUserData(id);
                setTimeout(() => {
                    if (user.status == 'success') {
                        $("#tambahAduan #pekerjaan").val(user.data.pekerjaan);
                        $("#tambahAduan #jenis_kelamin").val(user.data.jenis_kelamin);
                        $("#tambahAduan #tanggal_lahir").val(user.data.tanggal_lahir);
                        $("#tambahAduan #alamat").val(user.data.alamat);
                    } else {
                        alert('Gagal mengambil data user');
                    }
                    $(".load_user_input").hide();
                }, 1000);
            }
        });

    });
</script>
<?= $this->endSection(); ?>