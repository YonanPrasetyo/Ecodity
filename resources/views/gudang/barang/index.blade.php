@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
    <h1>Data Transaksi</h1>
@endsection

@section('content')

{{-- @dd($transaksi->toArray()) --}}

@php
$heads = [
    'NO',
    'Nama Pelanggan',
    ['label' => 'Alamat', 'width' => 20],
    ['label' => 'Komoditas', 'width' => 15],
    ['label' => 'Total Patungan', 'width' => 15],
    ['label' => 'Opsi Pengiriman', 'width' => 15],
    ['label' => 'Status', 'width' => 10],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
    'data' => $transaksi->map(function ($item, $index) {
        // Status badge styling
        $statusBadge = '';
        switch($item['status']) {
            case 'belum':
                $statusBadge = '<span class="badge badge-warning">Belum</span>';
                break;
            case 'di gudang':
                $statusBadge = '<span class="badge badge-info">Di Gudang</span>';
                break;
            case 'selesai':
                $statusBadge = '<span class="badge badge-success">Selesai</span>';
                break;
            case 'dikirim':
                $statusBadge = '<span class="badge badge-primary">Dikirim</span>';
                break;
            default:
                $statusBadge = '<span class="badge badge-secondary">' . ucfirst($item['status']) . '</span>';
        }

        // Opsi pengiriman styling
        $pengirimanBadge = '';
        switch($item['opsi_pengiriman']) {
            case 'dikirim':
                $pengirimanBadge = '<span class="badge badge-primary">Dikirim</span>';
                break;
            case 'diambil':
                $pengirimanBadge = '<span class="badge badge-warninga">Diambil</span>';
                break;
            case 'diinapkan':
                $pengirimanBadge = '<span class="badge badge-dark">Diinapkan</span>';
                break;
            default:
                $pengirimanBadge = '<span class="badge badge-primary">' . ucfirst($item['opsi_pengiriman']) . '</span>';
        }

        $actionBtn = '';
        if ($item['opsi_pengiriman'] == 'diambil' && $item['status'] != 'selesai') {
            $actionBtn = '<button
                            class="btn btn-xs btn-default text-success mx-1 shadow btn-diambil"
                            data-toggle="modal"
                            data-target="#modalDiambil"
                            data-url="' . route('gudang.transaksi.diambil', ['id' => $item['id_transaksi']]) . '"
                            title="Sudah Diambil">
                            <i class="fa fa-lg fa-fw fa-check"></i> Diambil
                          </button>';
        }else if($item['opsi_pengiriman'] == 'dikirim' && $item['status'] == 'di gudang' && !$item['status'] != 'selesai') {
            $actionBtn = '<button
                            class="btn btn-xs btn-default text-primary mx-1 shadow btn-dikirim"
                            data-toggle="modal"
                            data-target="#modalDikirim"
                            data-url="' . route('gudang.transaksi.dikirim', ['id' => $item['id_transaksi']]) . '"
                            title="Sudah Dikirim">
                            <i class="fa fa-lg fa-fw fa-box"></i> Kirim
                          </button>';
        }elseif ($item['opsi_pengiriman'] == 'dikirim' && $item['status'] == 'dikirim' && !$item['status'] != 'selesai') {
            $actionBtn = '<button
                            class="btn btn-xs btn-default text-success mx-1 shadow btn-diambil"
                            data-toggle="modal"
                            data-target="#modalDiambil"
                            data-url="' . route('gudang.transaksi.diambil', ['id' => $item['id_transaksi']]) . '"
                            title="Sudah Dikirim">
                            <i class="fa fa-lg fa-fw fa-check"></i> Diterima
                          </button>' .
                          '<button
                            class="btn btn-xs btn-default text-warning mx-1 shadow btn-kembali"
                            data-toggle="modal"
                            data-target="#modalKembali"
                            data-url="' . route('gudang.transaksi.kembali', ['id' => $item['id_transaksi']]) . '"
                            title="Kembali ke Gudang">
                            <i class="fa fa-lg fa-fw fa-undo"></i> Kembali ke Gudang
                          </button>'
                          ;
        }

        return [
            $index + 1,
            $item['user']['nama'],
            $item['user']['alamat'],
            $item['patungan']['komoditas']['nama_komoditas'],
            number_format($item['total_patungan'], 0, ',', '.') . ' '. $item['patungan']['komoditas']['satuan'],
            $pengirimanBadge,
            $statusBadge,
            '<nobr>'. $actionBtn .'</nobr>',
        ];
    }),
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>

{{-- Compressed with style options / fill data using the plugin config --}}

@include('gudang.barang.diambil')
@include('gudang.barang.dikirim')
@include('gudang.barang.kembali')

@endsection
