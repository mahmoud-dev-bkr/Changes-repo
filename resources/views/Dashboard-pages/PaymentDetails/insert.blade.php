@extends("Dashboard-layouts.app-tailwind")
@section('content')
    <div class="p-7">

        <h1 class="my-3 mb-10 text-2xl font-semibold text-gray-700">Create a Payment Manually</h1>
        {!! Form::open(['route' => 'storepaymentdetails', 'class' => 'form-user']) !!}
        <div class="items-center my-2 input-group">
            <label class="block w-40">Company</label>
            <select name="company" class=" select select-bordered bg-base-300/50 w-80">
                <option disabled selected>Select Company</option>
                @foreach ($company as $com)
                    <option value="{{ $com->id }}">{{ $com->name_en }}</option>
                @endforeach
            </select>
        </div>

        <div class="items-center my-2 input-group">
            <label class="block w-40">Plan</label>
            <select name="plan" class=" select select-bordered bg-base-300/50 w-80">
                <option disabled selected>Select Plan</option>
                @foreach ($plan as $pl)
                    <option value="{{ $pl->id }}">{{ $pl->name_en }}</option>
                @endforeach
            </select>
        </div>

        <div class="items-center my-2 input-group">
            <label class="block w-40">Payment Methods</label>
            <select name="paymentmethod" class=" select select-bordered bg-base-300/50 w-80">
                <option disabled selected>Select Payment Methods</option>
                @foreach ($paymentMthod as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Payment Date </label>
            <input type="date" class="w-full input bg-base-300/50" name="pay_date" />
            <span id="startdate-error" class="text-red-700"></span>

        </div>

        <div class="items-center my-2 input-group">
            <label class="w-40">Start Date </label>
            <input type="date" class="w-full input bg-base-300/50" name="start_date" />
            <span id="startdate-error" class="text-red-700"></span>

        </div>

        {{-- <div class="items-center my-2 input-group">
            <label class="w-40">End Date </label>
            <input type="date" class="w-full input bg-base-300/50" name="end_date" />
            <span id="enddate-error" class="text-red-700"></span>
        </div> --}}


        <button type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Add
            Add Payment</button>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
@endsection
