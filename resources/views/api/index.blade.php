@extends('adminlte::page')

@section('title', 'API List')

@section('content_header')
    <h1>API List</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
    $heads = [
        'ID',
        'API Name',
        'URL',
    ];

    if (Gate::allows('isAdmin')) {
        $heads[] = 'Created By';
    }

    $config = [
        'data' => $data,
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp

    <a href="api/create" class="btn btn-primary mb-2 float-right">Create API</a>
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($config['data'] as $row)
            <tr>
                <td>{!! $row['id'] !!}</td>
                <td>{!! $row['table_name'] !!}</td>
                <td><a href="{!! $row['url'] !!}" target="_blank">{!! $row['url'] !!}</a></td>

                @if (Gate::allows('isAdmin'))
                <td>{!! $row->user->name !!}</td>
                @endif
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('js')
    <script type="text/javascript">
        $(function() {
            @if (session()->has('success'))
                Swal.fire(
                    "Good job!",
                    "{{ session('success') }}",
                    "success"
                )
            @endif
        });
    </script>
@stop
