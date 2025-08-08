@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
    <h1>Data Transaksi</h1>
@endsection

@section('content')

@php
$heads = [
    'NO',
    'Kode Transaksi',
    'Kode Patungan',
    'Nama Komoditas',
    'Total Patungan',
    'Harga Total',
    'Opsi Pengiriman',
    'Status',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
    'data' => $transaksi->map(function ($item, $index) {
        $btnInvoice =   '<button
                            class="btn btn-xs btn-default text-primary mx-1 shadow"
                            data-toggle="modal"
                            data-target="#modalInvoice"
                            data-url="' . route('pengguna.transaksi.invoice', ['id' => $item['id_transaksi']]) . '"
                            title="Invoice">
                            <i class="fa fa-lg fa-fw fa-file"></i> Invoice
                        </button>';

        return [
            $index + 1,
            '<strong>'.$item['kode_transaksi'].'</strong>',
            '<strong>'.$item['patungan']['kode_patungan'].'</strong>',
            $item['patungan']['komoditas']['nama_komoditas'],
            $item['total_patungan'] . ' ' . $item['patungan']['komoditas']['satuan'],
            number_format($item['patungan']['harga_total']),
            $item['opsi_pengiriman'],
            ucfirst($item['status']),
            '<nobr>'. $btnInvoice . '</nobr>',
        ];
    }),
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>

@include('pengguna.transaksi.invoice')

@endsection
