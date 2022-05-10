@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="overflow-x-auto p-7">
        <div class="my-10">
            <a href="{{ LaravelLocalization::localizeUrl(route('insertUserPage')) }}" class="rounded-full btn btn-info"><i
                    class="fa fa-plus"></i></a>
            <span class="mx-3 text-lg font-bold">create a new User</span>
        </div>

        <table class="table w-full my-4 table-zebra" id="usersDT">
            <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>Telephone 1</th>
                    <th>Telephone 2</th>
                    <th>Telephone 3</th>
                    <th>Role(s)</th>
                    <th>Actions</th>
                    <th>active</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        let usersDT = null;

        function setusersDT() {
            var url = "{{ route('getUsersData') }}";
            usersDT = $("#usersDT").DataTable({
                processing: true,
                serverSide: true,
                pageLength: 7,
                dom: "Bfrtip",
                buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                sorting: [0, "DESC"],
                ajax: url,

                language: {
                    paginate: {
                        "previous": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-left'></i>",
                        "next": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-right'></i>",
                    },
                },

                columns: [{
                        data: "name_en"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "Tel_1"
                    },
                    {
                        data: "Tel_2"
                    },
                    {
                        data: "Tel_3"
                    },
                    {
                        data: "roles"
                    },
                    {
                        data: "actions"
                    },
                    {
                        data: "active"
                    }

                ],
            });
        }
        $(function() {
            setusersDT();
        });

        const toggleActivation = (event, id) => {
            (async () => {
                try {
                    let checked = event.target.checked;

                    const rawResponse = await fetch('{{ route('toggleActiveUser') }}', {
                        method: 'PATCH',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            checked
                        })
                    });
                    const content = await rawResponse.json();
                    console.log(content);

                    if (content.error) {
                        notyf.error(content.error);
                    } else {
                        notyf.success(content.msg);
                    }
                } catch (err) {

                    console.log(err);
                }
            })
            ();

        }

    </script>

@endsection
