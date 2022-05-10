@extends("Dashboard-layouts.app-tailwind")
@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">update Message Alert</h1>
        {!! Form::open(['route' => 'EditAlert', 'class' => 'form-user']) !!}

        <div class="items-center my-2 input-group">
            <label class="w-40">Message (en)</label>
            <input type="text" class="w-full input bg-base-300/50" value="{{ $alert->message_en }}" name="msg_en" />
            <input type="text" class="w-full input bg-base-300/50" value="{{ $alert->id }}" name="alert_id" hidden />
            <span id="msgen-error" class="text-red-700"></span>
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Message (ar)</label>
            <input type="text" class="w-full input bg-base-300/50" value="{{ $alert->message_ar }}" name="msg_ar" />
            <span id="msgar-error" class="text-red-700"></span>

        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Start Date </label>
            <input type="date" class="w-full input bg-base-300/50" value="{{ $alert->start_date }}" name="start_date" />
            <span id="startdate-error" class="text-red-700"></span>

        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">End Date </label>
            <input type="date" class="w-full input bg-base-300/50" value="{{ $alert->end_date }}" name="end_date" />
            <span id="enddate-error" class="text-red-700"></span>
        </div>

        <div class="items-center my-2 input-group">
            <label class="block w-40">Message Type</label>
            <select name="type" class=" select select-bordered bg-base-300/50 w-80">
                {{-- enum('info', 'success', 'warning', 'error') 	utf8mb4_unicode_ci --}}
                <option value="info">{{ $alert->type }}</option>
                <option value="info">info</option>
                <option value="success">success</option>
                <option value="warning">warning</option>
                <option value="error">error</option>
            </select>
        </div>
        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
            Save Message</button>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')

    <script type="module">
        $(document).ready(function() {
            // ////////////////////////////

            $(".form-user").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('EditAlert') }}",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        let msg = data.msg;
                        notyf.success(msg);
                    },
                    error: function(err) {
                        console.log(err);
                        if (err.status == 422) {
                            // validation error
                            let message = err.responseJSON.message.split('.')[0]
                            notyf.error(message);
                        }
                    }
                });
            });

        });

    </script>

@endsection
