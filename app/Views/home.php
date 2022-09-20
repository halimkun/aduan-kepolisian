<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-12 col-12 col-sm-12 order-md-2 order-sm-2 order-xs-2 order-lg-1">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik Bulanan</h4>
                </div>
                <div class="card-body">
                    <canvas id="statistikBulanan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 order-md-1 order-sm-1 order-xs-1 order-lg-2">
            <div class="card card-statistic-2" data-toggle='tooltip' title="hari ini">
                <div class="card-icon bg-warning">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Aduan Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <?= count($aduan_terbaru) ?>
                    </div>
                </div>
            </div>

            <div class="card card-statistic-2">
                <div class="card-icon bg-success">
                    <i class="fa fa-clipboard-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Aduan</h4>
                    </div>
                    <div class="card-body">
                        <?= count($aduan) ?>
                    </div>
                </div>
            </div>

            <div class="card card-statistic-2">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <?= count($pengguna) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('bottomLibrary'); ?>
<script src="<?= base_url('assets/modules/chart.min.js') ?>"></script>

<script>
    var ctx = document.getElementById('statistikBulanan').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php foreach ($monthly as $bulan) : ?> '<?= DateTime::createFromFormat('!m', $bulan->bulan)->format('M'); ?>',
                <?php endforeach; ?>
            ],
            datasets: [{
                data: [
                    <?php foreach ($monthly as $bulan) : ?>
                        <?= $bulan->total ?>,
                    <?php endforeach; ?>
                ],
                label: 'Aduan',
                borderColor: '#6777ef',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6777ef',
                borderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            ticks: {
                beginAtZero: true,
                stepSize: 1,
            },
            legend: {
                display: false
            }
        }
    });
</script>
<?= $this->endSection(); ?>