@extends('adminlte::page')

@section('title', 'Access Table')

@section('content_header')
    <h1>Access Table</h1>
@stop

@section('content')
    <form action="/users/{!! $user->id !!}/tables" method="post">
        @method('PUT')
        @csrf
        <div class="row">
            @php
            $config = [
                "placeholder" => "Select tables",
                "allowClear" => true,
            ];
            @endphp
            <x-adminlte-select2 id="tables" name="tables[]" label="Tables"
                :config="$config" fgroup-class="col-md-6" multiple error-key='table_id'>
                @foreach ($tables as $table)
                    <option {!! (in_array($table->name, $user->table_list) ? 'selected' : '') !!}
                        value="{!! $table->id !!}">{!! $table->name !!}</option>
                @endforeach
            </x-adminlte-select2>
        </div>

        <div class="row">
            <div class="form-group col-md-11">
                <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
                <a href="/users" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
    </script>
@stop
