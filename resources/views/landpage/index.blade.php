@extends('landpage.layout')

@section('cdnStyle')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('styles')
    <style>
        #banner {
            width: 100vw;
            height: 100%;
            display: block;
            position: absolute;
            top: 50%;
            transform: scale(1.5) rotateZ(14.5deg);
            z-index: -1;
        }

        #banner path {
            stroke: transparent;
        }


        .plan ul li::before {
            content: url('/icons/tick.svg');
            margin: 0 1rem
        }

        .plan div {
            clip-path: polygon(0 0, 100% 0, 100% 80%, 0% 100%);
        }

        #Contact-info {
            position: relative;
        }

        #Contact-info .button-top {
            position: absolute;
            display: block;
            z-index: 10;
            left: 0;
            right: 0;
            top: -25px;
            width: 50px;
            height: 50px;
            margin: auto;
            border-radius: 50%;
            font-size: 18px;
            line-height: 46px;
            text-align: center;
            cursor: pointer !important;
            background: #316cd4;
            opacity: 0.5;
        }

        #Contact-info .button-top:hover {
            opacity: 1;
            transition: ease-in-out 0.5s;
        }

        #Contact-info .button-top a {
            color: #fff;
        }

        #Contact-info .contact-info-main {
            position: relative;
            background: #2e2e2e;
            padding-top: 60px;
            padding-bottom: 60px;
            background-image: url('/images/dotted-map.png');
            background-size: contain;
        }

        #Contact-info .Contact-content {
            text-align: center;
            width: 90%;
            margin: auto;
            padding-top: 2.3rem;
            padding-bottom: 2.3rem;
            display: flex;
            justify-content: space-around;
        }

        .contact-info-main .Contact-text h4 {
            font-size: 20px;
            text-align: center;
            color: #fff;
            padding-bottom: 8px;
        }

        .contact-info-main .Contact-text p {
            font-size: 15px;
            padding: 5px;
            color: #fff;
        }

        #Contact-info .contact-info-main .Contact-text ul {
            text-align: center;
            padding-left: 5px;
        }

        #Contact-info .contact-info-main .Contact-text ul li {
            list-style: none;
            padding: 4px 0;
        }

        #Contact-info .contact-info-main .Contact-text ul li a {
            text-decoration: none;
            color: #fff;
        }

        #Contact-info .contact-info-main .Contact-text ul li a:hover {
            color: #316cd4;
            transition: ease-in-out 0.4s;
        }

        #Contact-info .contact-info-main .Contact-text .tags .tag {
            display: block;
            float: left;
            color: #fff;
            margin-right: 8px;
            margin-bottom: 8px;
            padding: 2px 10px;
            font-size: 1.5rem;
            text-decoration: none;
            border-radius: 3px;
            /* border: 1px solid #eee; */
        }

        #Contact-info .contact-info-main .tags .tag:hover {
            color: #316cd4;
            transition: ease-in-out 0.4s;
            border-color: #316cd4;
        }

        #footer {
            background: #2e2e2e;
            padding-top: 1rem;
            padding-bottom: 1rem;
            color: #fff;
        }

        .footer-content {
            text-align: center;
            font-size: 20px;
        }

        .footer-content a {
            text-decoration: none;
            color: #fff;
        }

        .footer-content a:hover {
            color: #316cd4;
            transition: ease-in-out 0.2s;
        }

    </style>
@endsection
@section('content')
    {{-- header section --}}
    <div class="relative h-auto pb-40 md:h-screen md:pb-4 bg-primary" id="header"
        style="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? 'clip-path: polygon(0 0, 100% 0, 100% 100%, 0 90%);' : 'clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);' }}">

        {{-- <svg viewBox="0 0 480 235" fill="none" id="banner">
        <path
          d="M479 0.20105L4.38662 134.207C-4.48439 171.421 1.02328 227.9 58.3061 233.51C132.727 240.798 94.2813 164.851 195.966 134.207C290.831 105.618 434.876 104.474 479 0.20105Z"
          fill="#2254ab"
          stroke="black"
          strokeWidth="0.0740389"
        />
      </svg> --}}

        <div class="flex flex-col justify-between h-full px-10 md:flex-row">
            <div class="flex flex-col justify-center w-full md:w-1/2">
                <h1 class="text-5xl font-bold leading-normal text-gray-50" data-aos="fade-left">
                    Amazing employees deserve<br>Amazing Software
                </h1>
                <p class="my-5 text-2xl font-bold text-gray-300/90" data-aos="fade-left">
                    Ai Attend Allows you to easily manage your employees/students...etc attendence
                    by using Ai Technologies like face recognition and finger print
                </p>
                <div data-aos="zoom-in" class="mt-7">
                    <button class="mx-2 my-2 btn-md md:btn-lg btn btn-teal-700">See plans</button>
                    <button class="mx-2 my-2 btn-md md:btn-lg btn btn-success">Contact Us</button>
                </div>
            </div>
            {{-- header image --}}
            <div class="relative flex flex-col justify-center h-full mt-5 md:mt-0 md:flex-1">
                <img src="/images/banner.png" alt="banner" class="object-cover w-full" />
            </div>

        </div>

    </div>
    {{-- qualities --}}
    <div class="py-20 mx-3 mt-10 shadow-xl md:mx-10 bg-white/95 backdrop-blur-md mb-7"
        style="clip-path: polygon(0 0, 100% 0, 100% 95%, 0% 100%);">
        <h2 class="mb-10 text-3xl font-bold text-center md:text-5xl">Why <span class="text-primary">Ai</span> Attend ?
        </h2>

        <div class="flex flex-col items-center justify-between p-4 mx-auto lg:p-10 lg:flex-row lg:w-9/12">
            <div class="w-full px-3 lg:w-1/2" data-aos="zoom-in">
                <h3 class="my-2 text-2xl font-bold">Diversity in attendance methods</h3>
                <p class="px-4 leading-loose text-gray-500">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Commodi sapiente consequuntur mollitia, dolorem est ducimus alias et assumenda? Cumque rem,
                    obcaecati dicta animi iure, consequuntur ab ducimus maiores, voluptates sint illo! Autem animi harum
                    saepe maxime eius, itaque iusto reprehenderit praesentium omnis tempore, officia ipsum perspiciatis
                    impedit quibusdam adipisci distinctio!</p>
            </div>
            <img class="w-full lg:w-1/2 mt-7 lg:mt-0" src="/images/fast.jpg" data-aos="zoom-in" />
        </div>


        <div class="flex flex-col items-center justify-between p-4 mx-auto lg:p-10 lg:flex-row lg:w-9/12">
            <img class="w-full lg:w-1/2 mt-7 lg:mt-0" src="/images/easy.jpg" data-aos="zoom-in" />

            <div class="w-full px-3 lg:w-1/2" data-aos="zoom-in">
                <h3 class="my-2 text-2xl font-bold">Easy to use</h3>
                <p class="px-4 leading-loose text-gray-500">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Commodi sapiente consequuntur mollitia, dolorem est ducimus alias et assumenda? Cumque rem,
                    obcaecati dicta animi iure, consequuntur ab ducimus maiores, voluptates sint illo! Autem animi harum
                    saepe maxime eius, itaque iusto reprehenderit praesentium omnis tempore, officia ipsum perspiciatis
                    impedit quibusdam adipisci distinctio!</p>
            </div>
        </div>


        <div class="flex flex-col items-center justify-between p-4 mx-auto lg:p-10 lg:flex-row lg:w-9/12">
            <div class="w-full px-3 lg:w-1/2" data-aos="zoom-in">
                <h3 class="my-2 text-2xl font-bold">Diversity in attendance methods</h3>
                <p class="px-4 leading-loose text-gray-500">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Commodi sapiente consequuntur mollitia, dolorem est ducimus alias et assumenda? Cumque rem,
                    obcaecati dicta animi iure, consequuntur ab ducimus maiores, voluptates sint illo! Autem animi harum
                    saepe maxime eius, itaque iusto reprehenderit praesentium omnis tempore, officia ipsum perspiciatis
                    impedit quibusdam adipisci distinctio!</p>
            </div>
            <img class="w-full lg:w-1/2 mt-7 lg:mt-0" src="/images/fast.jpg" data-aos="zoom-in" />
        </div>



    </div>

    {{-- plans --}}
    <h5 class="text-5xl font-bold text-center">Our <span class="text-primary">Plans</span></h5>



    <div class="flex flex-wrap justify-center py-5 px-7 md:px-10">
        {{-- plan --}}
        @foreach ($plans as $plan)
        @if($plan->activate == 1)
            <div data-aos="zoom-in" class="flex flex-col justify-between w-full m-4 bg-white rounded-3xl plan md:w-80">
                <div class="text-white bg-blue-500 p-7 py-14 rounded-t-3xl">
                    <h1 class="text-3xl font-bold">{{ $plan->name_en }}</h1>
                    <span class="mt-2 text-4xl font-light">{{ $plan->coast }}$ /{{ $plan->duration_days }} Days</span>
                </div>
                <div class="flex flex-1 flex-col items-center justify-center text-3xl font-bold text-primary text-center py-10">
                    Max Emplayee Number {{ $plan->max_emp }}
                </div>
                <div class="flex flex-1 flex-col items-center justify-center text-3xl font-bold text-primary text-center py-10">
                    Max Emplayee Number {{ $plan->max_emp }}
                </div>
                <button
                    class="mx-auto text-white border-0 btn btn-lg bg-gradient-to-r my-7 from-cyan-500 to-blue-500"><a href="{{route('Registration.landpage',$plan->id)}}">Order</a></button>
            </div>
        @else
        
        @endif
        @endforeach
            
        {{-- @for ($i = 0; $i < 5; $i++)

            

        @endfor --}}


        <div data-aos="zoom-in"
            class="flex flex-col items-center justify-center w-full m-4 bg-primary rounded-3xl plan md:w-80">
            <h1 class="my-4 text-xl font-bold text-white">More than 100 employees ?</h1>
            <button class="text-gray-900 bg-white border-0 btn btn-lg">Contact us</button>
        </div>

    </div>
    {{-- contact us --}}


    <div class="w-full mx-auto" style="z-index: -1;">
        <div class="p-10 my-5 bg-white shadow-xl md:p-20">
            <form method="POST" action="https://herotofu.com/start">
                <label class="block mb-6">
                    <span class="text-gray-700">Your name</span>
                    <input type="text" name="name"
                        class="w-full px-2 py-3 rounded bg-base-100/40 outline-1 outline-gray-200"
                        placeholder="Joe Bloggs" />
                </label>
                <label class="block mb-6">
                    <span class="text-gray-700">Email address</span>
                    <input name="email" type="email"
                        class="w-full px-2 py-3 rounded bg-base-100/40 outline-1 outline-gray-200"
                        placeholder="joe.bloggs@example.com" required />
                </label>
                <label class="block mb-6">
                    <span class="text-gray-700">Message</span>
                    <textarea name="message" class="w-full px-2 py-3 rounded bg-base-100/40 outline-1 outline-gray-200"
                        rows="3" placeholder="Tell us what you're thinking about..."></textarea>
                </label>
                <div class="mb-6">
                    <button type="submit"
                        class="h-10 px-5 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                        Contact Us
                    </button>
                </div>

            </form>
        </div>
    </div>

    @include('landpage.footer')
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700
        });

    </script>
@endsection
