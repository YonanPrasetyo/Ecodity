@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <i class="fas fa-seedling text-success fa-3x mb-3"></i>
                <h2 class="mb-3">Selamat Datang di <strong>Ecodity</strong>!</h2>

                <div class="alert alert-success">
                    Anda login sebagai <strong>{{ Auth::user()->email }}</strong><br>
                    dengan peran <span class="badge bg-primary text-white">{{ Auth::user()->role }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

