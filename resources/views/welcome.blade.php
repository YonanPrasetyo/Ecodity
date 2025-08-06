@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')

hallo anda adalah {{ Auth::user()->email }} <br>
dengan role {{ Auth::user()->role }}

@endsection
