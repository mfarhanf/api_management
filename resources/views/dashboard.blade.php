@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<p>Welcome {{ Auth::user()->name }} to The API Management Application.</p>
@stop
