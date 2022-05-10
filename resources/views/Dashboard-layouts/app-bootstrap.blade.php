<!DOCTYPE html>
<html lang={{ LaravelLocalization::getCurrentLocale() }}
    dir={{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'rtl' : 'ltr' }} data-theme="mytheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" />
    @yield('cdnStyle')
    @yield('styles')
</head>

<body>
    @yield('content')


    <script src="{{ asset('/js/bootsrap-bundle.js') }}" type="text/javascript"></script>
    @yield('scripts')
</body>

</html>
