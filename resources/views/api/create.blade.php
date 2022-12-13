@extends('adminlte::page')

@section('title', 'Create API')

@section('content_header')
    <h1>Create API</h1>
@stop

@section('content')
    <form action="store" method="post">
        @csrf
        <div class="row">
            <x-adminlte-input name="api_name" label="API Name" fgroup-class="col-md-6" disable-feedback/>
        </div>

        <div class="row">
            <x-adminlte-select name="table_name" label="Table" fgroup-class="col-md-6">
                <x-adminlte-options :options="$tables"
                    empty-option="Select an option..."/>
            </x-adminlte-select>
        </div>

        <div class="row">
            @php
            $config = [
                "placeholder" => "Select multiple options...",
                "allowClear" => true,
            ];
            @endphp
            <x-adminlte-select2 id="columns" name="columns[]" label="Column"
                :config="$config" fgroup-class="col-md-6" multiple>
                <option>id</option>
                <option>name</option>
            </x-adminlte-select2>

            <x-adminlte-input-switch name="is_distinct" data-on-text="YES" data-off-text="NO"
                label="I would like to receive distinct value (unique value)"/>
        </div>

        <div class="row">
            <x-adminlte-select name="filter" label="Filter By" fgroup-class="col-md-4">
                <x-adminlte-options :options="$columns['products']"
                    empty-option="Select an option..."/>
            </x-adminlte-select>

            <x-adminlte-select name="operator" label="&nbsp;" fgroup-class="col-md-4">
                <x-adminlte-options :options="$operators"
                    empty-option="Select an option..."/>
            </x-adminlte-select>

            <x-adminlte-input name="operator_value" label="&nbsp;" fgroup-class="col-md-4" disable-feedback/>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </div>
        </div>
    </form>
@stop
