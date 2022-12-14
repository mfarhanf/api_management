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

        <div class="row filter-section">
            <x-adminlte-select name="filter[]" label="Filter By" fgroup-class="col-md-4">
                <x-adminlte-options :options="$columns['products']"
                    empty-option="Select an option..."/>
            </x-adminlte-select>

            <x-adminlte-select name="operator[]" label="&nbsp;" fgroup-class="col-md-4">
                <x-adminlte-options :options="$operators"
                    empty-option="Select an option..."/>
            </x-adminlte-select>

            <x-adminlte-input name="operator_value[]" label="&nbsp;" fgroup-class="col-md-3" disable-feedback/>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <div class="input-group">
                    <x-adminlte-button type="button" class="delete" theme="danger" icon="fas fa-lg fa-minus" disabled/>
                </div>
            </div>
        </div>

        <div class="row and-or-section" style="display: none;">
            <x-adminlte-select name="and_or[]" fgroup-class="col-md-1">
                <x-adminlte-options :options="['and' => 'AND', 'or' => 'OR']"/>
            </x-adminlte-select>
        </div>

        <div class="row">
            <div class="form-group col-md-11">
                <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
            </div>
            <div class="form-group col-md-1">
                <x-adminlte-button type="button" class="add" theme="success" icon="fas fa-lg fa-plus"/>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(function() {
            $('.add').on('click', function() {
                // clone filter section
                var element = $(this).parent().parent().prev().prev().clone(true);
                $(this).parent().parent().prev().after(element);
                $('.delete:last').prop("disabled", false);
                $(this).parent().parent().prev().children().children('label').remove();
                $('input:last').val('');

                // clone and or section
                var element = $(this).parent().parent().prev().prev().clone(true);
                $(this).parent().parent().prev().after(element);
                $('.and-or-section:last').prev().prev().show();
            })

            $('.delete').on('click', function() {
                $(this).parent().parent().parent().prev().remove();
                $(this).parent().parent().parent().remove();
            })
        });
    </script>
@stop
