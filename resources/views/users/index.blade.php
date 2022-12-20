@extends('adminlte::page')

@section('title', 'User List')

@section('content_header')
    <h1>User List</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
    @php
    $heads = [
        'ID',
        'Name',
        'Email',
        'Tables',
        '',
    ];

    $config = [
        'data' => $data,
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp

    <a href="users/create" class="btn btn-primary mb-2 float-right">Create User</a>
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($config['data'] as $row)
            <tr>
                <td>{!! $row['id'] !!}</td>
                <td>{!! $row['name'] !!}</td>
                <td>{!! $row['email'] !!}</td>
                <td>{!! $row['table_list'] !!}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a href="users/edit/{{ $row['id'] }}" class="dropdown-item">Edit User</a>
                            <a href="users/{{ $row['id'] }}/tables" class="dropdown-item">Access Table</a>
                        </div>
                    </div>
                </td>
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
