<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-auto w-auto md:w-[100vw] md:h-[100vh] flex flex-col lg:flex-row">
        <div class="w-full h-full flex items-center justify-center flex-col">
            <img src="<?= base_url('/assets/img/illustrator/Paper map-rafiki.svg') ?>" alt="report image" class="w-[90%] lg:w-[75%] 2xl:w-[60%]">
            <small><a href="https://storyset.com/location" class="text-gray-400">Location illustrations by Storyset</a></small>
        </div>
        <div class="w-full h-full my-8 md:my-0 text-center flex items-center justify-center lg:items-start 2xl:items-center flex-col px-10 xl:px-20 2xl:px-40">
            <h1 class="text-4xl font-bold">Aduan Kepolisian</h1>
            <p class="text-gray-500">Kami ada untuk membantu anda sekarang!</p>

            <div class="mt-10 flex gap-3">
                <a href="<?= base_url('home/user') ?>" class="py-2 px-8 bg-[#6777ef] rounded-lg shadow-xl shadow-[#6777ef3d] hover:scale-110 hover:rounded-sm duration-300 text-white">
                    User
                </a>
                <a href="<?= base_url('admin') ?>" class="py-2 px-8 bg-white rounded-lg shadow-xl hover:scale-110 hover:rounded-sm duration-300 text-[#333]">
                    Admin
                </a>
            </div>
        </div>
    </div>
</body>

</html>