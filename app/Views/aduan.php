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
                <table class="table table-striped" id="tableAduan">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Aduan</th>
                            <th>Aduan</th>
                            <th>Keterangan</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
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

<!-- JS Libraies -->
<script src="<?= base_url('assets/modules/select2/dist/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#tableAduan').DataTable();
        $('.user_select').on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '<?= base_url('user/getById') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.status == 'success') {
                        $("#tambahAduan #pekerjaan").val(res.data.pekerjaan);
                        $("#tambahAduan #jenis_kelamin").val(res.data.jenis_kelamin);
                        $("#tambahAduan #tanggal_lahir").val(res.data.tanggal_lahir);
                        $("#tambahAduan #alamat").val(res.data.alamat);
                    } else {
                        alert('Gagal mengambil data user');
                    }
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>