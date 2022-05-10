@extends('dashboard-layouts.app-tailwind')

@section('content')
    <div class="p-4 my-10">
        <a href="{{ LaravelLocalization::localizeUrl(route('addCompany')) }}" class="rounded-lg btn btn-info">
            <i class="fa fa-plus"></i>
            <span class="mx-3 text-lg font-bold">Add a company manually</span>
        </a>
    </div>
    <div class="overflow-x-auto p-7">


        <table class="table w-full my-4 table-zebra" id="companiesDt">
            <thead>
                <tr>

                    <th>Name (en)</th>
                    <th>Name (ar)</th>
                    <th>Tel 1</th>
                    <th>Tel 2</th>
                    <th>Tel 3</th>
                    <th>email</th>
                    <th>website</th>
                    <th>main address</th>
                    <th>location</th>
                    <th>commercial record</th>
                    <th>tax card</th>
                    <th>active</th>
                    <th>current plan</th>
                    <th>timezone</th>
                    <th>added/updated manually by</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        let companiesDt = null;

        function setcompaniesDt() {
            var url = "{{ route('getCompaniesData') }}";
            companiesDt = $("#companiesDt").DataTable({
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
                        data: "name_ar"
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
                        data: "email"
                    },
                    {
                        data: "website"
                    },
                    {
                        data: "main_address"
                    },
                    {
                        data: "location"
                    },
                    {
                        data: 'commercial_record'
                    },
                    {
                        data: 'tax_card'
                    },
                    {
                        data: 'active'
                    },
                    {
                        data: 'current_plan_id'
                    },
                    {
                        data: 'timezone'
                    },
                    {
                        data: 'user'
                    },
                    {
                        data:'edite'
                    }

                ],
            });
        }
        $(function() {
            setcompaniesDt();
        });

    </script>
@endsection
