<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}
    dir={{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }} data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/app.css" />

    {{-- inline styles --}}
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        .arabic {
            font-family: 'Droid Arabic Kufi', serif;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 5px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #10326e;
        }

        .dataTables_empty {
            background-color: rgb(189, 61, 61);
            color: white;
            padding: 5px 10px;
            display: inline;
            text-align: center;
        }

        .dataTables_paginate {
            float: right;
            display: flex;
            align-items: center;
        }

        .dataTables_processing {
            position: absolute;
            left: 50%;
            top: 10%;
            transform: translateX(50%);
            background: rgb(213, 213, 235);
            font-weight: bold;
            font-size: 1.3rem;
            padding: 7px 1rem;
            z-index: 9999;
            border-radius: 15px;
        }


        .dataTables_filter input {
            padding: 10px 5px;
            margin: 0 1rem;
            border-radius: 7px;
            border: 1px solid #eeee;
            outline: 0;
            background-color: rgba(218, 222, 236, 0.933)
        }


        .dataTables_paginate>* {
            margin: 0 7px;
        }

        .dataTables_paginate span>* {
            margin: 0 7px;
            font-weight: bolder
        }

        .dataTables_paginate span>*:hover {}

        .dataTables_paginate span>*.current {}


        .dashboard-item-active {
            border-right: 5px solid white;
            border-bo-radius: 4px;
            border-bottom-right-radius: 2px;
        }

        .input {
            outline-offset: 0px !important;
            outline-color: #f8f8f8
        }

        .table thead th:first-child {
            position: relative !important;
        }

        .table td {
            border: 1px solid rgb(209, 209, 209) !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('/css/notyf.min.css') }}">

    @yield('cdnStyle')
    @yield('styles')

</head>

<body class=" bg-light">
    <div class="pt-5 m-auto w-50">
        {{-- @include('dashboard-layouts.inc.sidebar') --}}
        <div class="w-full h-auto md:h-screen md:overflow-auto">
            {{-- navbar --}}
            {{-- @include('dashboard-layouts.inc.navbar') --}}
            <div class="h-auto overflow-y-auto md:flex-1">
                @yield('content')
            </div>

        </div>
    </div>


    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    {{-- font awesome --}}
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    {{-- nofty --}}
    <script src="{{ asset('/js/notyf.min.js') }}"></script>
    <script type="application/javascript">
        var notyf = new Notyf({
            duration: 5000 // Set your global Notyf configuration here
        });

    </script>
    @yield('scripts')
</body>

</html>
