@if ($type == 'togglePMethodsActive')


    <input type="checkbox" onchange="toggleactivate('{{ $id }}','{{ $active_state }}')" class="toggle"
        name="active" {{ $active_state ? 'checked' : '' }} />


@endif
