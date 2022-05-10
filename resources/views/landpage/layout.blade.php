<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}
    dir={{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }} data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ai Attend</title>
    <link rel="stylesheet" href="/css/app.css" />
    @yield('cdnStyle')
    @yield('styles')
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        .arabic {
            font-family: 'Droid Arabic Kufi', serif;
        }

        .nav-items {
            font-size: 1.2rem;
        }

        .nav-items li {
            text-align: center;
            margin: 0 1rem;
        }

        nav {
            z-index: 999;
            top: 0;
        }

        img {
            object-fit: cover
        }

        body {
            overflow-x: hidden
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #184593;
        }

    </style>
</head>

<body>
    <nav class="fixed inset-x-0 px-2 py-4 bg-white border-gray-200 shadow-lg sm:px-4">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="/" class="flex items-center">
                <img src="https://www.availo.app/Content/images/AvailoLogo.png" class="h-6 mx-3 sm:h-9"
                    alt="Flowbite Logo" />
                <span class="self-center text-3xl font-semibold whitespace-nowrap"><span class="text-primary">Ai</span>
                    Attend</span>
            </a>
            <button onclick="showMobileMenue()" data-collapse-toggle="mobile-menu" type="button"
                class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <i class="text-4xl fa fa-bars"></i>
            </button>
            <div class="hidden w-full h-screen ease-in-out md:h-auto md:block md:w-auto duration-600" id="mobile-menu">
                <ul
                    class="flex flex-col items-center h-full mt-4 space-y-4 md:space-y-0 nav-items md:flex-row md:mt-0 md:font-medium">
                    <li
                        class="after:content-[''] after:mt-1 after:block after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20 mx-2">
                        Home
                    </li>
                    <li>
                        <a href="#"
                            class="bafter:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="after:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="after:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20">Pricing</a>
                    </li>
                    <li>
                        <a href="#"
                            class="after:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20">Contact</a>
                    </li>



                    {{-- lang --}}
                    <li class="text-info">
                        @if (LaravelLocalization::getCurrentLocale() == 'en')
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}"
                                class="after:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary arabic after:z-20">العربية</a>

                        @else
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}"
                                class="after:content-[''] after:block after:mt-1 after:w-0 hover:after:w-full after:ease-in-out after:transition-all after:duration-400 after:h-0.5 after:bg-primary after:z-20">English</a>
                        @endif
                    </li>
                    <li>
                        <button class="btn btn-primary btn-lg"><i class="mx-2 fa-solid fa-right-to-bracket"></i> Log
                            in</button>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    @yield('content')
    <script>
        const showMobileMenue = () => {
            document.getElementById('mobile-menu').classList.toggle('hidden')
        }

    </script>
    @yield('scripts')
</body>

</html>
