@extends("Dashboard-layouts.app-tailwind")
@section('content')
<div class="overflow-x-auto p-7">
    <div class="my-10">
        <a href="{{ LaravelLocalization::localizeUrl(route('insertalertPage')) }}" class="rounded-full btn btn-info"><i
                class="fa fa-plus"></i></a>
        <span class="mx-3 text-lg font-bold">create a new Alert</span>
    </div>

    <table class="table w-full my-4 table-zebra" id="alertDT">
        <thead>
            <tr>
                <th>Message English</th>
                <th>Message Arabic</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Created By</th>                    
                <th>Created Date</th>
                <th>Modify Data</th>
                <th>Message Type</th>
                <th>Action</th>
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
        
    let alertDT = null;
    function setalertDT() {
        // alert("hiii");
        var url = "{{ route('getalertdata') }}";
        alertDT = $("#alertDT").DataTable({
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
            columns: [
                {
                    data: "message_en"
                },
                {
                    data:"message_ar"
                },
                {
                    data:"start_date"
                },
                {
                    data:"end_date"
                },
                {
                    data:"username"
                },
                {
                    data:"created_at"
                },
                {
                    data:"updated_at"
                },
                {
                    data:"message_type"
                },
                {
                    data:"isActive"
                },
                {
                    data:"action"
                }
            ],
        });
        }
        $(function() {
            setalertDT();
        });

        const toggleactivate = (id, activeState) => {
            // alert(activeState);
    (async () => {
        try{const rawResponse = await fetch('{{ route("togglealertactivate") }}', {
            method: 'PATCH',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            body: JSON.stringify({
                id,
                active_state: activeState
            })
        });
        const content = await rawResponse.json();
        console.log(content);
        notyf.success(content.msg);
        alertDT.ajax.reload()
    }
        catch(err){
            console.log(err);
        }
    })
    ();
}
    </script>
@endsection