@extends('adminlte::page')

@section('title', 'Data Komoditas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Data Komoditas</h1>

        <button
                class="btn btn-xs btn-default text-primary mx-1 shadow"
                title="Tambah"
                data-toggle="modal"
                data-target="#modalAddKomoditas">
                <i class="fa fa-lg fa-fw fa-plus"></i> Tambah
        </button>
    </div>
@endsection

@section('content')

@php
$heads = [
    'NO',
    'Nama Komoditas',
    'Harga',
    'Pabrik',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
    'data' => $komoditas->map(function ($data) {
            $btnEdit = '<button
                class="btn btn-xs btn-default text-primary mx-1 shadow btn-edit-komoditas"
                data-toggle="modal"
                data-target="#modalEditKomoditas"
                data-nama-komoditas="' . $data->nama_komoditas . '"
                data-harga-per-satuan="' . $data->harga_per_satuan . '"
                data-satuan="' . $data->satuan . '"
                data-pabrik="' . $data->pabrik . '"
                data-url-update="' . route('admin.komoditas.update', ['id' => $data->id_komoditas]) . '"
                title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i> Edit
            </button>';

            $btnDelete = '<button
                class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete-komoditas"
                data-toggle="modal"
                data-target="#modalDeleteKomoditas"
                data-url-delete="' . route('admin.komoditas.delete', ['id' => $data->id_komoditas]) . '"
                title="Delete">
                <i class="fa fa-lg fa-fw fa-trash"></i> Hapus
            </button>';

            return [
                $data->id_komoditas,
                $data->nama_komoditas,
                number_format($data->harga_per_satuan, 0, ',', '.') . ' / ' . $data->satuan,
                $data->pabrik,
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        }),
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
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

@include("admin.komoditas.add")

@include("admin.komoditas.edit")

@include("admin.komoditas.delete")

@endsection
