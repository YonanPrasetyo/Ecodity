@extends('adminlte::page')

@section('title', 'Data Patungan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Patungan - Gudang</h1>

        <button
            class="btn btn-xs btn-default text-primary mx-1 shadow"
            title="Tambah"
            data-toggle="modal"
            data-target="#modalAddPatungan">
            <i class="fa fa-lg fa-fw fa-plus"></i> Tambah
        </button>
    </div>
@endsection

@section('content')

<div class="row">
    @foreach($patungan as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-box"></i> {{ $item['komoditas']['nama_komoditas'] }}
                </h3>
                <div class="card-tools">
                    @if($item['status'] == 'dibuka')
                        <span class="badge badge-success">{{ ucfirst($item['status']) }}</span>
                    @elseif($item['status'] == 'full')
                        <span class="badge badge-danger">{{ ucfirst($item['status']) }}</span>
                    @elseif($item['status'] == 'dikirim')
                        <span class="badge badge-info">{{ ucfirst($item['status']) }}</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($item['status']) }}</span>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div>
                    <strong>Total Barang:</strong><br>
                    {{ $item['total_terkumpul'] }} {{ $item['komoditas']['satuan'] }}
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <small class="text-muted col-6">
                        <i class="fas fa-calendar"></i>
                        {{ date('d/m/Y', strtotime($item['created_at'])) }}
                    </small>

                    <div class="d-flex justify-content-end align-items-center col-6">
                        <button
                            class="btn btn-xs btn-default text-primary shadow btn-datang-patungan"
                            data-toggle="modal"
                            data-target="#modalDatangPatungan"
                            data-pabrik="{{ $item['komoditas']['pabrik'] }}"
                            data-nama-komoditas="{{ $item['komoditas']['nama_komoditas'] }}"
                            data-terkumpul="{{ $item['total_terkumpul'] }} {{ $item['komoditas']['satuan'] }}"
                            data-url-datang="{{ route('gudang.patungan.datang', $item['id_patungan']) }}"
                            data-url-gambar="{{ asset('storage/' . $item['bukti_pembelian']) }}"
                            title="Datang">
                            <i class="fa fa-lg fa-fw fa-truck"></i> Datang
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

@include('gudang.kiriman.datang')

@endsection
