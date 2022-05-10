@extends('Dashboard-layouts.app-landpage')
@section('styles')
    <style>
        #suggestions li {
            padding: 10px 7px;
            transition: all ease-in-out 0.4s;
            cursor: pointer;
        }

        #suggestions li:hover {
            background: #eeee
        }

    </style>
@endsection
@section('content')
    <div class="p-7">
        {!! Form::open(['route' => 'Registration.post.landpage', 'class' => 'form-company']) !!}

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Name (en)</label>
            <input type="text" class="w-full input bg-base-300/50" name="name_en" />
        </div>
        <div class="divider"></div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Name (ar)</label>
            <input type="text" class="w-full input bg-base-300/50" name="name_ar" />
        </div>
        <div class="divider"></div>


        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">email</label>
            <input type="email" class="w-full input bg-base-300/50" name="email" />
        </div>
        <div class="divider"></div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Telephone 1</label>
            <input type="text" class="w-full input bg-base-300/50" name="tel1" />
        </div>
        <div class="divider"></div>


        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Telephone 2 (optional)</label>
            <input type="text" class="w-full input bg-base-300/50" name="tel2" />
        </div>
        <div class="divider"></div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Telephone 3 (optional)</label>
            <input type="text" class="w-full input bg-base-300/50" name="tel3" />
        </div>

        <div class="divider"></div>


        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">website (optional)</label>
            <input type="text" class="w-full input bg-base-300/50" name="website" />
        </div>

        <div class="divider"></div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">main address</label>
            <input type="text" class="w-full input bg-base-300/50" name="address" />
        </div>




        <div class="divider"></div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">longitude</label>
            <input type="text" class="w-full input bg-base-300/50" id="lng" name="long" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">latitude</label>
            <input type="text" class="w-full input bg-base-300/50" id="lat" name="lat" />
        </div>

        <div class="my-4">
            <label for="my-modal-4" class="btn modal-button">select location from map</label>
            <input type="checkbox" id="my-modal-4" class="modal-toggle" />
            <label for="my-modal-4" class="cursor-pointer modal">
                <label class="relative modal-box" for="">
                    <div id="map" class="mx-auto h-80"></div>

                </label>
            </label>
        </div>

        <div class="divider"></div>


        <div class="items-center my-4 input-group">
            <label class="font-bold w-80 arabic">رابط السجل التجاري على الدرايف الخاص بالشركة</label>
            <input type="text" class="w-full input bg-base-300/50" id="lng" name="commercial_record" />
        </div>
        <div class="divider"></div>

        <div class="items-center my-4 input-group">
            <label class="font-bold w-80 arabic">رابط البطاقة الضريبية على الدرايف الخاص بالشركة</label>
            <input type="text" class="w-full input bg-base-300/50" id="lng" name="tax_card" />
        </div>



        <div class="divider"></div>
        <div class="flex items-center my-4">
            <label class="font-bold w-80">timezone</label>
            <div class="relative w-full">
                <input type="text" id="input" class="w-full input bg-base-300/50" name="timezone" />
                <ul id="suggestions" style="max-height: 200px!important;"
                    class="absolute block w-full px-4 overflow-auto bg-white shadow-lg rounded-box">
                </ul>
            </div>
        </div>


        <div class="items-center my-4 input-group">
            <label class="font-bold w-80">note (optional)</label>
            <input type="text" class="w-full input bg-base-300/50" id="lng" name="note" />
        </div>


        <div class="items-center my-2 input-group">
            <input type="text" name="plan_id" value="{{ $plan_id }}" hidden>
        </div>


        {{-- <div class="items-center my-2 input-group"> --}}
            {{-- <label class="block font-bold w-80">payment method</label> --}}
            {{-- <select name="pay_method" class="select select-bordered bg-base-300/50">
                @foreach ($methods as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select> --}}
        {{-- </div> --}}


        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Payment Date </label>
            <input type="date" class="w-full input bg-base-300/50" name="pay_date" />
            <span id="startdate-error" class="text-red-700"></span>

        </div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Start Date </label>
            <input type="date" class="w-full input bg-base-300/50" name="start_date" />
            <span id="startdate-error" class="text-red-700"></span>

        </div>


        {{-- <p class="font-bold text-gray-400 arabic"> سيتم تخزين وصل دفع للشركة للباقة
            المختارة</p>
        <p class="font-bold text-gray-400">a new payment invoice will be registered with the
            selected plan</p> --}}




        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block mx-3 px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out mt-5">Add
            Company</button>



        <svg role="status" id="loader"
            class="hidden inline-block w-8 h-8 my-4 mr-2 text-gray-200 hideden animate-spin dark:text-gray-600 fill-blue-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill" />
        </svg>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')

    <script>
        // submit the form
        $(".form-company").submit(function(e) {
            $('#loader').removeClass('hidden')

            e.preventDefault();
            $.ajax({
                url: "{{ route('Registration.post.landpage') }}",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                },
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#loader').addClass('hidden')
                    console.log(data);
                    let msg = data.msg;
                    notyf.success(msg);
                },
                error: function(err) {
                    console.log(err);
                    $('#loader').addClass('hidden')
                    if (err.status == 422) {
                        // validation error
                        let message = err.responseJSON.message.split('.')[0]
                        notyf.error(message);
                    } else if (err.status == 401) {

                    }
                }
            });
        });

    </script>


    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn1ZmThbXMe-8C-boHXrWFupCBpT8LmnU&callback=initMap"></script>
    <script>
        window.onload = function() {
            var latlng = new google.maps.LatLng(30.0444, 31.2357);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function(a) {
                var lat = a.latLng.lat();
                var lng = a.latLng.lng();
                $('#lat').val(lat)
                $('#lng').val(lng)

            });
        };

    </script>
    <script>
        (function() {
            "use strict";
            let inputField = document.getElementById('input');
            let ulField = document.getElementById('suggestions');
            inputField.addEventListener('input', changeAutoComplete);
            ulField.addEventListener('click', selectItem);

            function changeAutoComplete({
                target
            }) {
                let data = target.value;
                ulField.innerHTML = ``;
                if (data.length) {
                    let autoCompleteValues = autoComplete(data);
                    autoCompleteValues.forEach(value => {
                        addItem(value);
                    });
                }
            }


            function autoComplete(inputValue) {
                let destination = [
                    'Europe/Andorra',
                    'Asia/Dubai',
                    'Asia/Kabul',
                    'Europe/Tirane',
                    'Asia/Yerevan',
                    'Antarctica/Casey',
                    'Antarctica/Davis',
                    'Antarctica/DumontDUrville', // https://bugs.chromium.org/p/chromium/issues/detail?id=928068
                    'Antarctica/Mawson',
                    'Antarctica/Palmer',
                    'Antarctica/Rothera',
                    'Antarctica/Syowa',
                    'Antarctica/Troll',
                    'Antarctica/Vostok',
                    'America/Argentina/Buenos_Aires',
                    'America/Argentina/Cordoba',
                    'America/Argentina/Salta',
                    'America/Argentina/Jujuy',
                    'America/Argentina/Tucuman',
                    'America/Argentina/Catamarca',
                    'America/Argentina/La_Rioja',
                    'America/Argentina/San_Juan',
                    'America/Argentina/Mendoza',
                    'America/Argentina/San_Luis',
                    'America/Argentina/Rio_Gallegos',
                    'America/Argentina/Ushuaia',
                    'Pacific/Pago_Pago',
                    'Europe/Vienna',
                    'Australia/Lord_Howe',
                    'Antarctica/Macquarie',
                    'Australia/Hobart',
                    'Australia/Currie',
                    'Australia/Melbourne',
                    'Australia/Sydney',
                    'Australia/Broken_Hill',
                    'Australia/Brisbane',
                    'Australia/Lindeman',
                    'Australia/Adelaide',
                    'Australia/Darwin',
                    'Australia/Perth',
                    'Australia/Eucla',
                    'Asia/Baku',
                    'America/Barbados',
                    'Asia/Dhaka',
                    'Europe/Brussels',
                    'Europe/Sofia',
                    'Atlantic/Bermuda',
                    'Asia/Brunei',
                    'America/La_Paz',
                    'America/Noronha',
                    'America/Belem',
                    'America/Fortaleza',
                    'America/Recife',
                    'America/Araguaina',
                    'America/Maceio',
                    'America/Bahia',
                    'America/Sao_Paulo',
                    'America/Campo_Grande',
                    'America/Cuiaba',
                    'America/Santarem',
                    'America/Porto_Velho',
                    'America/Boa_Vista',
                    'America/Manaus',
                    'America/Eirunepe',
                    'America/Rio_Branco',
                    'America/Nassau',
                    'Asia/Thimphu',
                    'Europe/Minsk',
                    'America/Belize',
                    'America/St_Johns',
                    'America/Halifax',
                    'America/Glace_Bay',
                    'America/Moncton',
                    'America/Goose_Bay',
                    'America/Blanc-Sablon',
                    'America/Toronto',
                    'America/Nipigon',
                    'America/Thunder_Bay',
                    'America/Iqaluit',
                    'America/Pangnirtung',
                    'America/Atikokan',
                    'America/Winnipeg',
                    'America/Rainy_River',
                    'America/Resolute',
                    'America/Rankin_Inlet',
                    'America/Regina',
                    'America/Swift_Current',
                    'America/Edmonton',
                    'America/Cambridge_Bay',
                    'America/Yellowknife',
                    'America/Inuvik',
                    'America/Creston',
                    'America/Dawson_Creek',
                    'America/Fort_Nelson',
                    'America/Vancouver',
                    'America/Whitehorse',
                    'America/Dawson',
                    'Indian/Cocos',
                    'Europe/Zurich',
                    'Africa/Abidjan',
                    'Pacific/Rarotonga',
                    'America/Santiago',
                    'America/Punta_Arenas',
                    'Pacific/Easter',
                    'Asia/Shanghai',
                    'Asia/Urumqi',
                    'America/Bogota',
                    'America/Costa_Rica',
                    'America/Havana',
                    'Atlantic/Cape_Verde',
                    'America/Curacao',
                    'Indian/Christmas',
                    'Asia/Nicosia',
                    'Asia/Famagusta',
                    'Europe/Prague',
                    'Europe/Berlin',
                    'Europe/Copenhagen',
                    'America/Santo_Domingo',
                    'Africa/Algiers',
                    'America/Guayaquil',
                    'Pacific/Galapagos',
                    'Europe/Tallinn',
                    'Africa/Cairo',
                    'Africa/El_Aaiun',
                    'Europe/Madrid',
                    'Africa/Ceuta',
                    'Atlantic/Canary',
                    'Europe/Helsinki',
                    'Pacific/Fiji',
                    'Atlantic/Stanley',
                    'Pacific/Chuuk',
                    'Pacific/Pohnpei',
                    'Pacific/Kosrae',
                    'Atlantic/Faroe',
                    'Europe/Paris',
                    'Europe/London',
                    'Asia/Tbilisi',
                    'America/Cayenne',
                    'Africa/Accra',
                    'Europe/Gibraltar',
                    'America/Godthab',
                    'America/Danmarkshavn',
                    'America/Scoresbysund',
                    'America/Thule',
                    'Europe/Athens',
                    'Atlantic/South_Georgia',
                    'America/Guatemala',
                    'Pacific/Guam',
                    'Africa/Bissau',
                    'America/Guyana',
                    'Asia/Hong_Kong',
                    'America/Tegucigalpa',
                    'America/Port-au-Prince',
                    'Europe/Budapest',
                    'Asia/Jakarta',
                    'Asia/Pontianak',
                    'Asia/Makassar',
                    'Asia/Jayapura',
                    'Europe/Dublin',
                    'Asia/Jerusalem',
                    'Asia/Kolkata',
                    'Indian/Chagos',
                    'Asia/Baghdad',
                    'Asia/Tehran',
                    'Atlantic/Reykjavik',
                    'Europe/Rome',
                    'America/Jamaica',
                    'Asia/Amman',
                    'Asia/Tokyo',
                    'Africa/Nairobi',
                    'Asia/Bishkek',
                    'Pacific/Tarawa',
                    'Pacific/Enderbury',
                    'Pacific/Kiritimati',
                    'Asia/Pyongyang',
                    'Asia/Seoul',
                    'Asia/Almaty',
                    'Asia/Qyzylorda',
                    'Asia/Qostanay', // https://bugs.chromium.org/p/chromium/issues/detail?id=928068
                    'Asia/Aqtobe',
                    'Asia/Aqtau',
                    'Asia/Atyrau',
                    'Asia/Oral',
                    'Asia/Beirut',
                    'Asia/Colombo',
                    'Africa/Monrovia',
                    'Europe/Vilnius',
                    'Europe/Luxembourg',
                    'Europe/Riga',
                    'Africa/Tripoli',
                    'Africa/Casablanca',
                    'Europe/Monaco',
                    'Europe/Chisinau',
                    'Pacific/Majuro',
                    'Pacific/Kwajalein',
                    'Asia/Yangon',
                    'Asia/Ulaanbaatar',
                    'Asia/Hovd',
                    'Asia/Choibalsan',
                    'Asia/Macau',
                    'America/Martinique',
                    'Europe/Malta',
                    'Indian/Mauritius',
                    'Indian/Maldives',
                    'America/Mexico_City',
                    'America/Cancun',
                    'America/Merida',
                    'America/Monterrey',
                    'America/Matamoros',
                    'America/Mazatlan',
                    'America/Chihuahua',
                    'America/Ojinaga',
                    'America/Hermosillo',
                    'America/Tijuana',
                    'America/Bahia_Banderas',
                    'Asia/Kuala_Lumpur',
                    'Asia/Kuching',
                    'Africa/Maputo',
                    'Africa/Windhoek',
                    'Pacific/Noumea',
                    'Pacific/Norfolk',
                    'Africa/Lagos',
                    'America/Managua',
                    'Europe/Amsterdam',
                    'Europe/Oslo',
                    'Asia/Kathmandu',
                    'Pacific/Nauru',
                    'Pacific/Niue',
                    'Pacific/Auckland',
                    'Pacific/Chatham',
                    'America/Panama',
                    'America/Lima',
                    'Pacific/Tahiti',
                    'Pacific/Marquesas',
                    'Pacific/Gambier',
                    'Pacific/Port_Moresby',
                    'Pacific/Bougainville',
                    'Asia/Manila',
                    'Asia/Karachi',
                    'Europe/Warsaw',
                    'America/Miquelon',
                    'Pacific/Pitcairn',
                    'America/Puerto_Rico',
                    'Asia/Gaza',
                    'Asia/Hebron',
                    'Europe/Lisbon',
                    'Atlantic/Madeira',
                    'Atlantic/Azores',
                    'Pacific/Palau',
                    'America/Asuncion',
                    'Asia/Qatar',
                    'Indian/Reunion',
                    'Europe/Bucharest',
                    'Europe/Belgrade',
                    'Europe/Kaliningrad',
                    'Europe/Moscow',
                    'Europe/Simferopol',
                    'Europe/Kirov',
                    'Europe/Astrakhan',
                    'Europe/Volgograd',
                    'Europe/Saratov',
                    'Europe/Ulyanovsk',
                    'Europe/Samara',
                    'Asia/Yekaterinburg',
                    'Asia/Omsk',
                    'Asia/Novosibirsk',
                    'Asia/Barnaul',
                    'Asia/Tomsk',
                    'Asia/Novokuznetsk',
                    'Asia/Krasnoyarsk',
                    'Asia/Irkutsk',
                    'Asia/Chita',
                    'Asia/Yakutsk',
                    'Asia/Khandyga',
                    'Asia/Vladivostok',
                    'Asia/Ust-Nera',
                    'Asia/Magadan',
                    'Asia/Sakhalin',
                    'Asia/Srednekolymsk',
                    'Asia/Kamchatka',
                    'Asia/Anadyr',
                    'Asia/Riyadh',
                    'Pacific/Guadalcanal',
                    'Indian/Mahe',
                    'Africa/Khartoum',
                    'Europe/Stockholm',
                    'Asia/Singapore',
                    'America/Paramaribo',
                    'Africa/Juba',
                    'Africa/Sao_Tome',
                    'America/El_Salvador',
                    'Asia/Damascus',
                    'America/Grand_Turk',
                    'Africa/Ndjamena',
                    'Indian/Kerguelen',
                    'Asia/Bangkok',
                    'Asia/Dushanbe',
                    'Pacific/Fakaofo',
                    'Asia/Dili',
                    'Asia/Ashgabat',
                    'Africa/Tunis',
                    'Pacific/Tongatapu',
                    'Europe/Istanbul',
                    'America/Port_of_Spain',
                    'Pacific/Funafuti',
                    'Asia/Taipei',
                    'Europe/Kiev',
                    'Europe/Uzhgorod',
                    'Europe/Zaporozhye',
                    'Pacific/Wake',
                    'America/New_York',
                    'America/Detroit',
                    'America/Kentucky/Louisville',
                    'America/Kentucky/Monticello',
                    'America/Indiana/Indianapolis',
                    'America/Indiana/Vincennes',
                    'America/Indiana/Winamac',
                    'America/Indiana/Marengo',
                    'America/Indiana/Petersburg',
                    'America/Indiana/Vevay',
                    'America/Chicago',
                    'America/Indiana/Tell_City',
                    'America/Indiana/Knox',
                    'America/Menominee',
                    'America/North_Dakota/Center',
                    'America/North_Dakota/New_Salem',
                    'America/North_Dakota/Beulah',
                    'America/Denver',
                    'America/Boise',
                    'America/Phoenix',
                    'America/Los_Angeles',
                    'America/Anchorage',
                    'America/Juneau',
                    'America/Sitka',
                    'America/Metlakatla',
                    'America/Yakutat',
                    'America/Nome',
                    'America/Adak',
                    'Pacific/Honolulu',
                    'America/Montevideo',
                    'Asia/Samarkand',
                    'Asia/Tashkent',
                    'America/Caracas',
                    'Asia/Ho_Chi_Minh',
                    'Pacific/Efate',
                    'Pacific/Wallis',
                    'Pacific/Apia',
                    'Africa/Johannesburg'
                ];

                return destination.filter(
                    (value) => value.toLowerCase().includes(inputValue.toLowerCase())
                );
            }

            function addItem(value) {
                ulField.innerHTML = ulField.innerHTML + `<li>${value}</li>`;
            }

            function selectItem({
                target
            }) {
                if (target.tagName === 'LI') {
                    inputField.value = target.textContent;
                    ulField.innerHTML = ``;
                }
            }
        })();

    </script>


@endsection