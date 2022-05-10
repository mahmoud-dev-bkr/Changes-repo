<div class="flex flex-col h-auto py-4 overflow-auto border-0 md:h-screen bg-primary md:w-1/4">
    <div class="flex items-center mx-auto my-4 text-2xl font-bold">
        <span class="flex items-center justify-center w-10 h-10 p-2 mr-2 bg-white rounded-2xl text-secondary">AI</span>
        <h1 class="text-white">Attend</h1>
    </div>

    <div class="flex flex-col my-5 text-lg font-bold">


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin') ? 'dashboard-item-active' : '' }}
        " href=" /admin">
            Home</a>


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/company') ? 'dashboard-item-active' : '' }}
            " href=" /admin/company">
            Companies</a>

        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('/admin/company/reqeusts') ? 'dashboard-item-active' : '' }}
            " href=" /admin/company/reqeusts">
            Request Companies</a>



        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/paymentdetails') ? 'dashboard-item-active' : '' }}
            " href=" /admin/paymentdetails">
            Payment details</a>





        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/Plan/') ? 'dashboard-item-active' : '' }}
            " href="{{ url('admin/Plan/') }}">
            Plans</a>



        @if (Auth::user() && Auth::user()->hasRole('super_admin'))
            <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/users') ? 'dashboard-item-active' : '' }}
            " href=" /admin/users">
                Users</a>
        @endif

        {{-- @if (Auth::user() && Auth::user()->hasRole('super_admin')) --}}
        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/paymentsmethods/') ? 'dashboard-item-active' : '' }}
        " href="{{ url('admin/paymentsmethods/') }}">
            Payment Methods</a>
        {{-- @endif --}}


        {{-- @if (Auth::user() && Auth::user()->hasRole('super_admin')) --}}
        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/alerts') ? 'dashboard-item-active' : '' }}
        " href="{{ url('admin/alerts') }}">
            Alert Messages</a>
        {{-- @endif --}}









        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
        {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/roles') ? 'dashboard-item-active' : '' }}
        " href=" /admin/roles">
            Roles</a>


        <a class="w-full py-4 font-bold text-center text-gray-100 duration-300 ease-in-out hover:bg-neutral/25
            {{ LaravelLocalization::getNonLocalizedURL(Request::path()) == url('admin/terms') ? 'dashboard-item-active' : '' }}
            " href=" /admin/terms">
            Terms and Conditions</a>

    </div>



</div>
