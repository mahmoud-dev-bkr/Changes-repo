<style>
    .red {
        color: red;
    }

</style>
@if ($type == 'togglealertActive')
    @if ($active_state)
        <button onclick="toggleactivate('{{ $id }}','{{ $active_state }}')"
            class="btn btn-error">Disactive</button>
    @else
        <button onclick="toggleactivate('{{ $id }}', '{{ $active_state }}')"
            class="btn btn-primary">Active</button>
    @endif
@endif
@if ($type == 'action')

    <a href="{{ url("admin/alerts/deletealert/{$id}") }}"><i class="text-2xl fa fa-trash red me-2"></i></a>
    <a href="{{ url("admin/alerts/update/{$id}") }}"><i class="text-2xl fa fa-pen text-primary"></i></a>
@endif
@if ($type == 'alert')
    <p class="bg-{{ $msg_type }}">{{ $msg_type }}</p>
@endif
