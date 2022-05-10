@extends('dashboard-layouts.app-tailwind')
@section('content')
    <div class="overflow-x-auto p-7">
        {{-- <div class="my-10">
            <a href="{{ LaravelLocalization::localizeUrl(route('insertUserPage')) }}" class="rounded-full btn btn-info"><i
                    class="fa fa-plus"></i></a>
            <span class="mx-3 text-lg font-bold">create a new User</span>
        </div> --}}



        <table class="table w-full my-4 table-zebra" id="paymentDT">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Account number</th>
                    <th>Note</th>
                    <th>Added date</th>
                    <th>Modified date</th>
                    <th>Activate</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        let paymentDT = null;

        function setusersDT() {
            var url = "{{ route('getPaymentData') }}";
            paymentDT = $("#paymentDT").DataTable({
                processing: true,
                serverSide: true,
                pageLength: 7,
                dom: "Bfrtip",
                buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
                // sorting: [0, "DESC"],
                ajax: url,
                language: {
                    paginate: {
                        "previous": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-left'></i>",
                        "next": "<i class='text-lg cursor-pointer fa text-secondary fa-caret-right'></i>",
                    },
                },
                columns: [{
                        data: "name"
                    },
                    {
                        data: "details"
                    },
                    {
                        data: "note"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "updated_at"
                    },
                    {
                        data: "isActive"
                    },
                ],
            });
        }
        $(function() {
            setusersDT();
        });

        const toggleactivate = (id, activeState) => {
            (async () => {
                try {
                    const rawResponse = await fetch('{{ route('toggleactivate') }}', {
                        method: 'PATCH',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            active_state: activeState
                        })
                    });
                    const content = await rawResponse.json();
                    // console.log(content);
                    if (content.error) {
                        notyf.error(content.error);
                    } else {
                        notyf.success(content.msg);
                    }
                    paymentDT.ajax.reload()
                } catch (err) {
                    console.log(err);
                }
            })
            ();
        }

    </script>
@endsection
