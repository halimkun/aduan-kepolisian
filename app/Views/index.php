<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/modules/fontawesome/css/all.min.css') ?>">
</head>

<body>
    <div class="w-auto w-auto md:w-[100vw] md:h-[100vh] flex flex-col lg:flex-row">
        <div class="w-full h-full flex items-center justify-center flex-col">
            <img src="<?= base_url('/assets/img/illustrator/Paper map-rafiki.svg') ?>" alt="report image" class="w-[90%] lg:w-[75%] 2xl:w-[60%]">
            <small><a href="https://storyset.com/location" class="text-gray-400">Location illustrations by Storyset</a></small>
        </div>
        <div class="w-full h-full my-8 md:my-0 text-center flex items-center justify-center lg:items-start 2xl:items-center flex-col px-10 xl:px-20 2xl:px-40">
            <h1 class="text-4xl font-bold">SISTEM PELAPORAN KEJADIAN</h1>
            <p class="text-gray-500">POLSEK BOJONG</p>

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
                        <i class="fas fa-sign-in-alt mr-2"></i> Log In
                    </a>
                    <?php if ($config->allowRegistration) : ?>
                        <div class="mt-3 text-gray-500 text-sm">
                            Don't have an account? <a class="text-indigo-600" href="<?= url_to('register') ?>">Create One</a>
                        </div>
                    <?php endif; ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>

</html>