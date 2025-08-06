@extends('adminlte::page')
@section('title', 'Detail Patungan')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detail Patungan</h1>
        <a href="{{ route('admin.patungan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@endsection

@section('content')
<!-- Card Info Patungan -->
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-box"></i> {{ $patungan['komoditas']['nama_komoditas'] }}
                </h3>
                <div class="card-tools">
                    @if($patungan['status'] == 'dibuka')
                        <span class="badge badge-success badge-lg">{{ ucfirst($patungan['status']) }}</span>
                    @elseif($patungan['status'] == 'full')
                        <span class="badge badge-danger badge-lg">{{ ucfirst($patungan['status']) }}</span>
                    @else
                        <span class="badge badge-secondary badge-lg">{{ ucfirst($patungan['status']) }}</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Target Patungan:</strong></td>
                                <td>{{ $patungan['total'] }} {{ $patungan['komoditas']['satuan'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sudah Terkumpul:</strong></td>
                                <td>{{ $patungan['total_terkumpul'] }} {{ $patungan['komoditas']['satuan'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sisa Kebutuhan:</strong></td>
                                <td>{{ $patungan['total'] - $patungan['total_terkumpul'] }} {{ $patungan['komoditas']['satuan'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Peserta:</strong></td>
                                <td>{{ $patungan['total_transaksi'] }} orang</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Pabrik:</strong></td>
                                <td>{{ $patungan['komoditas']['pabrik'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga per {{ $patungan['komoditas']['satuan'] }}:</strong></td>
                                <td>Rp {{ number_format($patungan['komoditas']['harga_per_satuan']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Total Nilai:</strong></td>
                                <td>Rp {{ number_format($patungan['komoditas']['harga_per_satuan'] * $patungan['total']) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ date('d M Y H:i', strtotime($patungan['created_at'])) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mt-4">
                    <h5><strong>Progress Patungan</strong></h5>
                    <div class="progress progress-lg">
                        <div class="progress-bar bg-primary" role="progressbar"
                             style="width: {{ $patungan['presentase'] }}%"
                             aria-valuenow="{{ $patungan['presentase'] }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ number_format($patungan['presentase'], 1) }}%
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted">0 {{ $patungan['komoditas']['satuan'] }}</small>
                        <small class="text-muted">{{ $patungan['total'] }} {{ $patungan['komoditas']['satuan'] }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Summary -->
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i> Ringkasan
                </h3>
            </div>
            <div class="card-body">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success">
                        <i class="fas fa-check"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Terkumpul</span>
                        <span class="info-box-number">{{ $patungan['total_terkumpul'] }} {{ $patungan['komoditas']['satuan'] }}</span>
                    </div>
                </div>

                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sisa Kebutuhan</span>
                        <span class="info-box-number">{{ $patungan['total'] - $patungan['total_terkumpul'] }} {{ $patungan['komoditas']['satuan'] }}</span>
                    </div>
                </div>

                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Peserta</span>
                        <span class="info-box-number">{{ $patungan['total_transaksi'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card Daftar Transaksi -->
<div class="row">
    <div class="col-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Daftar Transaksi Peserta
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">ID User</th>
                                <th width="15%">Jumlah Patungan</th>
                                <th width="15%">Opsi Pengiriman</th>
                                <th width="10%">Status</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Nilai (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patungan['transaksi'] as $index => $transaksi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $transaksi['id_user'] }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-primary badge-lg">
                                        {{ $transaksi['total_patungan'] }} {{ $patungan['komoditas']['satuan'] }}
                                    </span>
                                </td>
                                <td>
                                    @if($transaksi['opsi_pengiriman'] == 'dikirim')
                                        <i class="fas fa-truck text-info"></i> Dikirim
                                    @elseif($transaksi['opsi_pengiriman'] == 'diambil')
                                        <i class="fas fa-hand-paper text-warning"></i> Diambil
                                    @else
                                        <i class="fas fa-home text-secondary"></i> {{ ucfirst($transaksi['opsi_pengiriman']) }}
                                    @endif
                                </td>
                                <td>
                                    @if($transaksi['status'] == 'selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($transaksi['status'] == 'dikirim')
                                        <span class="badge badge-info">Dikirim</span>
                                    @else
                                        <span class="badge badge-warning">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ date('d M Y H:i', strtotime($transaksi['created_at'])) }}</small>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($transaksi['total_patungan'] * $patungan['komoditas']['harga_per_satuan']) }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="2">Total</th>
                                <th>
                                    <span class="badge badge-success badge-lg">
                                        {{ $patungan['total_terkumpul'] }} {{ $patungan['komoditas']['satuan'] }}
                                    </span>
                                </th>
                                <th colspan="3"></th>
                                <th>
                                    <strong>Rp {{ number_format($patungan['total_terkumpul'] * $patungan['komoditas']['harga_per_satuan']) }}</strong>
                                </th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
