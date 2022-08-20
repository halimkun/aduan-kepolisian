<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Aduan</h1>
        <!-- <div class="section-header-breadcrumb">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAduanInfo">
                <i class="fa fa-info-circle"></i>
            </button>
        </div> -->
    </div>
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
    // ready
    $(document).ready(function() {
        $('#tableAduan').DataTable();
    });
</script>
<?= $this->endSection(); ?>