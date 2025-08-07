@extends('adminlte::page')

@section('title', 'Data Patungan')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Patungan</h1>

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
                <div class="row">
                    <div class="col-6">
                        <strong>Target:</strong><br>
                        {{ $item['total'] }} {{ $item['komoditas']['satuan'] }}
                    </div>
                    <div class="col-6">
                        <strong>Terkumpul:</strong><br>
                        {{ $item['total_terkumpul'] }} {{ $item['komoditas']['satuan'] }}
                    </div>
                </div>

                <div class="mt-3">
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar"
                             style="width: {{ $item['presentase'] }}%"
                             aria-valuenow="{{ $item['presentase'] }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ number_format($item['presentase'], 1) }}%
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <small class="text-muted">
                            <i class="fas fa-industry"></i> {{ $item['komoditas']['pabrik'] }}
                        </small>
                    </div>
                    <div class="col-6 text-right">
                        <small class="text-muted">
                            <i class="fas fa-money-bill-wave"></i> Rp {{ number_format($item['komoditas']['harga_per_satuan']) }}/{{ $item['komoditas']['satuan'] }}
                        </small>
                    </div>
                </div>

                <div class="mt-3">
                    <strong>
                        <i class="fas fa-users"></i>
                        {{ $item['total_transaksi'] }} Peserta
                    </strong>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i>
                            {{ date('d/m/Y', strtotime($item['created_at'])) }}
                        </small>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <div>
                        <a href="{{ route('admin.patungan.show', $item['id_patungan']) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i> Detail
                        </a>
                    </div>
                    <div>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i> Edit
                        </button>
                    </div>
                    @if ($item['status'] == 'full')
                        <div>
                            <button
                                class="btn btn-xs btn-default text-danger mx-1 shadow btn-pesan-patungan"
                                data-toggle="modal"
                                data-target="#modalPesanPatungan"
                                data-pabrik="{{ $item['komoditas']['pabrik'] }}"
                                data-nama-komoditas="{{ $item['komoditas']['nama_komoditas'] }}"
                                data-terkumpul="{{ $item['total_terkumpul'] }} {{ $item['komoditas']['satuan'] }}"
                                data-url-pesan="{{ route('admin.patungan.pesan', $item['id_patungan']) }}"
                                title="Pesan">
                                <i class="fa fa-lg fa-fw fa-envelope"></i> Pesan
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('admin.patungan.add', ['komoditas' => $komoditas])

@include('admin.patungan.pesan')

@endsection
