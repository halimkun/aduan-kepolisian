<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1 class="text-<?= userColor() ?>">Data Status dan Jenis Aduan</h1>
    </div>

    <?= $this->include('Components/flash_message'); ?>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h4 class="text-<?= userColor() ?>">Data Jenis</h4>
                    </div>
                    <div class="card-body p-0">
                        <form action="/admin/status-jenis" class="p-3" method="post">
                            <input type="hidden" name="table" value="jenis">
                            <div class="d-flex" style="gap:10px;">
                                <input type="text" name="data" id="data" placeholder="tuliskan jenis aduan" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-sm shadow btn-<?= userColor() ?>"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>

                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Aduan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($jenis as $j) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $j->jenis_aduan ?></td>
                                        <td>
                                            <form action="/admin/status-jenis" method="post" onsubmit="return confirm('anda yakin akan menghapus jenis - <?= $j->jenis_aduan ?>')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="<?= $j->id_jenis ?>">
                                                <input type="hidden" name="table" value="jenis">
                                                <button type="submit" class="btn btn-sm btn-danger shadow"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h4 class="text-<?= userColor() ?>">Data Status</h4>
                    </div>
                    <div class="card-body p-0">
                        <form action="/admin/status-jenis" class="p-3" method="post">
                            <input type="hidden" name="table" value="status">
                            <div class="d-flex" style="gap:10px;">
                                <input type="text" name="data" id="data" placeholder="tuliskan status aduan" class="form-control form-control-sm">
                                <button type="submit" class="btn btn-sm shadow btn-<?= userColor() ?>"><i class="fa fa-plus"></i></button>
                            </div>
                        </form>

                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status Aduan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($status as $s) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $s->status_aduan ?></td>
                                        <td>
                                            <?php if (!in_array(strtolower($s->status_aduan), ['belum diproses', 'selesai'])) : ?>
                                                <form action="/admin/status-jenis" method="post" onsubmit="return confirm('anda yakin akan menghapus status - <?= $s->status_aduan ?>')">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="id" value="<?= $s->id_status ?>">
                                                    <input type="hidden" name="table" value="status">
                                                    <button type="submit" class="btn btn-sm btn-danger shadow"><i class="fa fa-trash"></i></button>
                                                </form>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>