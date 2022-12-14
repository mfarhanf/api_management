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
        @foreach($config['data'] as $row)
            <tr>
                <td>{!! $row['id'] !!}</td>
                <td>{!! $row['table_name'] !!}</td>
                <td><a href="{!! $row['url'] !!}" target="_blank">{!! $row['url'] !!}</a></td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop
