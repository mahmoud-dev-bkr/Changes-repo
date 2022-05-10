@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a new Plan</h1>
        {!! Form::open(['route' => 'insertPlan', 'class' => 'form-user']) !!}
        <div class="items-center my-2 input-group">
            <label class="w-40">Name (en)</label>
            <input type="text" class="input bg-base-300/50" name="name_en" placeholder="Enter name OF Plan En"/>
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Name (ar)</label>
            <input type="text" class="input bg-base-300/50" name="name_ar" placeholder="Enter name OF Plan Ar"/>
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Cost</label>
            <input type="text" class="input bg-base-300/50" name="coast" placeholder="Enter Only Number"/>
        </div>
        
        
        <div class="items-center my-2 input-group">
            <label class="w-40">Max Employee</label>
            <input type="text" class="input bg-base-300/50" name="max_employee" placeholder="Enter Max Employee"/>
        </div>
        
        <div class="items-center my-2 input-group">
            <label class="w-40">Duration Day</label>
            <input type="text" class="input bg-base-300/50" name="duration_day" placeholder="Enter Duration Day"/>
        </div>

        

        {{-- <div class="items-center my-2 input-group">
            <label class="block w-40">Role</label>
            <select name="role" class=" select select-bordered bg-base-300/50">
                <option disabled selected>Pick a role</option>
                @foreach ($roles as $r)
                    <option value="{{ $r->name }}">{{ $r->display_name }}</option>
                @endforeach
            </select>
        </div> --}}


        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
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
                    url: "{{ route('insertPlan') }}",
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
