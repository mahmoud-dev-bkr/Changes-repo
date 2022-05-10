@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Update Plan</h1>
        {!! Form::open(['route' => 'EditPlan', 'class' => 'form-user']) !!}

        <div class="items-center my-2 input-group">
            <input type="text" class="input bg-base-300/50" name="id" value="{{ $plan->id }}"
                placeholder="Enter name OF Plan En" hidden />
        </div>
        <div class="items-center my-2 input-group">
            <label class="w-40">Name (en)</label>
            <input type="text" class="input bg-base-300/50" name="name_en" value="{{ $plan->name_en }}"
                placeholder="Enter name OF Plan En" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Name (ar)</label>
            <input type="text" class="input bg-base-300/50" name="name_ar" value="{{ $plan->name_ar }}"
                placeholder="Enter name OF Plan Ar" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Cost</label>
            <input type="text" class="input bg-base-300/50" name="coast" value="{{ $plan->coast }}"
                placeholder="Enter Only Number" />
        </div>


        <div class="items-center my-2 input-group">
            <label class="w-40">Max Employee</label>
            <input type="text" class="input bg-base-300/50" name="max_employee" value="{{ $plan->max_emp }}"
                placeholder="Enter Max Employee" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Duration Day</label>
            <input type="text" class="input bg-base-300/50" name="duration_day" value="{{ $plan->duration_days }}"
                placeholder="Enter Duration Day" />
        </div>



        <div class="items-center my-2 input-group">
            <label class="block w-40">Status</label>
            <select name="status" class=" select select-bordered bg-base-300/50">
                @if ($plan->activate)
                    <option value=1>Activate</option>
                @else
                    <option value=0>Not Activate</option>
                @endif
                @if (!$plan->activate)
                    <option value=1>Activate</option>
                @else
                    <option value=0>Not Activate</option>
                @endif

            </select>
        </div>


        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Update
            Plan</button>

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
                    url: "{{ route('EditPlan') }}",
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
