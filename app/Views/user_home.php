<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .background-animate {
            background-size: 400%;
            -webkit-animation: 3s infinite AnimationName;
            -moz-animation: 3s infinite AnimationName;
            animation: 3s infinite AnimationName
        }

        @keyframes AnimationName {

            0%,
            100% {
                background-position: 0 50%
            }

            50% {
                background-position: 100% 50%
            }
        }
    </style>
</head>

<div class="w-full h-screen bg-gradient-to-r from-indigo-500 via-sky-500 to-violet-500 background-animate ">
    <div class="flex flex-row h-full items-center justify-center">
        <div class="w-full flex items-center justify-center hidden lg:block"></div>
        <div class="w-full flex items-center justify-center">
            <div class="bg-white w-[80%] md:w-[50%] lg:w-[87%] rounded-lg shadow-lg p-8">
                <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 background-animate capitalize">
                    ready to collaborate with us
                </h1>
                <p class="mt-2 text-gray-600">
                    Download dan install aplikasi ini untuk memulai kolaborasi dengan kami, dan membantu kami untuk membuat warga Indonesia lebih baik.
                </p>
                <div class="mt-10">
                    <a href="#!" class="px-8 py-3 rounded-lg shadow-lg hover:text-white hover:transition-all duration-300 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 background-animate">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

</html>