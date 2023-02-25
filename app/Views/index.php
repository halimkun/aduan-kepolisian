<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= base_url('assets/fav/favicon.ico') ?>" type="image/x-icon">

    <!-- PWA Start -->
    <meta name="theme-color" content="#6366F1" />
    <meta name="Description" content="mempermudah penggunaan untuk membuat laporan kepolisian" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-title" content="Laporan Kepolisian" />

    <meta name="msapplication-TileImage" content="/assets/fav/android-chrome-512x512.png" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />

    <link rel="apple-touch-icon" href="/assets/fav/apple-touch-icon.png" />

    <!-- manifest -->
    <link rel="manifest" href="/manifest.json" />
    <!-- PWA End -->

    <script>
        if (navigator.serviceWorker) {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('ServiceWorker registration successful with scope:', registration.scope);
            }).catch(function(error) {
                console.log('ServiceWorker registration failed:', errror);
            });
        }
    </script>
</head>

<body>
    <div class="w-[100vw] h-[100vh] flex flex-col items-center justify-center lg:flex-row">
        <div class="w-full h-full flex items-center justify-end md:justify-center flex-col">
            <img src="<?= base_url('/assets/img/illustrator/R.jpg') ?>" alt="report image" class="w-[70%] lg:w-[75%] 2xl:w-[60%]">
        </div>
        <div class="w-full h-full my-8 md:my-0 text-center flex items-center justify-start md:justify-center lg:items-start 2xl:items-center flex-col px-10 xl:px-20 2xl:px-40">
            <h1 class="text-4xl font-bold">Sistem Pelaporan Kejadian</h1>
            <h1 class="text-2xl">Polsek Bojong</h1>
            <div class="mt-10 flex <?= !logged_in() ? 'flex-col' : 'flex-row gap-3' ?>">
                <?php if (logged_in()) : ?>
                    <?php if (in_array('admin', user()->getRoles()) ||  in_array('petugas', user()->getRoles())) : ?>
                        <a href="/admin/" class="bg-indigo-600 text-white font-bold rounded shadow px-8 py-3 hover:bg-indigo-500">
                            <i class="fa fa-chart-line mr-2"></i> Dashboard
                        </a>
                    <?php else : ?>
                        <a href="/warga/" class="bg-indigo-600 text-white font-bold rounded shadow px-8 py-3 hover:bg-indigo-500">
                            <i class="fa fa-chart-line mr-2"></i> Dashboard
                        </a>
                    <?php endif ?>
                    <a href="/logout/" class="bg-red-500 text-white font-bold rounded shadow px-8 py-3 hover:bg-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </a>
                <?php else : ?>
                    <a href="/login" class="bg-indigo-600 text-white font-bold rounded shadow px-8 py-3 hover:bg-indigo-500">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </a>
                    <?php if ($config->allowRegistration) : ?>
                        <div class="mt-3 text-gray-500 text-sm">
                            belum memiliki akun? <a class="text-indigo-600" href="<?= url_to('register') ?>">Daftar sekarang</a>
                        </div>
                    <?php endif; ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>

</html>
