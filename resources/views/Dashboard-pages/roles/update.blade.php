@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-7">
        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">update role : {{ $role->display_name }}</h1>
        {!! Form::open(['route' => ['updateRole', 'id' => $role->id], 'class' => 'form-role', 'method' => 'PUT']) !!}

        <span class="font-light text-gray-500"><i class="fa fa-info"></i> Role name can contains "_" or "-" but not
            spaces</span>
        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Role Name (without spaces)</label>
            <input type="text" class="input bg-base-300/50" name="name" value="{{ $role->name }}" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="font-bold w-80">Role Display name</label>
            <input type="text" class="input bg-base-300/50" name="display_name" value="{{ $role->display_name }}" />
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-80">Note (optional)</label>
            <input type="text" class="input bg-base-300/50" name="note" value="{{ $role->note }}" />
        </div>

        <h1 class="font-bold">Permissions</h1>

        @foreach ($permissions as $p)
            <div class="flex items-center my-2">
                <input type="checkbox" class="mx-3 checkbox" value="{{ $p->id }}" name="permissions[]"
                    {{ $role->hasPermission($p->name) ? 'checked' : '' }} />
                <label>{{ $p->display_name }}</label>
            </div>
        @endforeach


        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Save
        </button>


        <svg role="status" id="loader"
            class="hidden w-8 h-8 my-4 mr-2 text-gray-200 hideden animate-spin dark:text-gray-600 fill-blue-600"
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
    <script type="module">
        $(document).ready(function() {
            // ////////////////////////////
            $(".form-role").submit(function(e) {
                $('#loader').removeClass('hidden')
                e.preventDefault();
                $.ajax({
                    url: "{{ route('updateRole', ['id' => $role->id]) }}",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data);
                        $('#loader').addClass('hidden')

                        let msg = data.msg;
                        notyf.success(msg);
                    },
                    error: function(err) {
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

        });

    </script>
@endsection
