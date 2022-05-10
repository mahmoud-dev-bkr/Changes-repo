@if ($type == 'roles')
    <ul class="w-56 menu">
        @foreach ($roles as $role)
            <li class="p-2 my-2 rounded-lg bg-base-200/25">{{ $role->name }}</li>
        @endforeach
    </ul>


@elseif($type == 'roles_users')
    <table class="table table-compact">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= $users->count(); $i++)
                <tr>
                    <th>{{ $i }}</th>
                    <th>{{ $users[$i - 1]->name_en }}</th>
                </tr>
            @endfor
        </tbody>
    </table>


@elseif($type == 'roles_actions')
    <div class="space-x-2">
        <a href="{{ route('updateRolePage', $id) }}" class="link"><i class="fa text-cyan-500 fa-edit"></i></a>
        {{-- <a class="link"><i class="text-red-500 fa fa-trash"></i></a> --}}
    </div>

@elseif ($type == "plan_profile")
    <a href="{{ route('EditPage', $plan_id) }}"><i class="fa fa-eye" style="color: black"></i></a>

@elseif ($type == "eompany_profile")
    <a href="{{ route('EditPageCompany', $company_id) }}"><i class="fa fa-eye" style="color: black"></i></a>

@elseif ($type == "request_edit")
    <a href="{{ route('RequestCompanyPageEdit', $company_id) }}"><i class="fa fa-eye" style="color: black"></i></a>

@elseif($type == 'file')
    {{-- <a class="link"><i class="text-blue-500 fa fa-eye"></i></a> --}}
    <a target="_blank" href="{{ $link }}" class="link"><i class="mx-auto text-blue-800 fa fa-file"></i></a>


@elseif($type == 'mailto')
    {{-- <a class="link"><i class="text-blue-500 fa fa-eye"></i></a> --}}
    <a href="mailto:{{ $email }}" class="link"><i class="mx-2 fa fa-envelope"></i> {{ $email }}</a>


@elseif($type == 'users_actions')
    <a href="{{ route('updatePage', $id) }}" class="link"><i class="fa text-cyan-500 fa-edit"></i></a>


@elseif($type == 'users_activation')
    <input type="checkbox" onchange="toggleActivation(event , '{{ $user->id }}')" class="toggle" name="active"
        {{ $user->isActive ? 'checked' : '' }} />
@endif
