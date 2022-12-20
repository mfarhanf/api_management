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

    $config = [
        'data' => $data,
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
     <a href="users/create" class="btn btn-primary mb-2">
                        Tambah
                    </a>
        @foreach($config['data'] as $row)
            <tr>
                <td>{!! $row['id'] !!}</td>
                <td>{!! $row['name'] !!}</td>
                <td>{!! $row['email'] !!}</td>
                <td>
                                    <a href="users/edit/{{$row['id']}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
