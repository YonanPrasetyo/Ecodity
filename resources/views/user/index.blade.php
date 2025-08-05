@extends('adminlte::page')

@section('title', 'Data Pelanggan')

@section('content_header')
    <h1>Data Pelanggan</h1>
@endsection

@section('content')

@php
$heads = [
    'NO',
    'Nama',
    ['label' => 'Email', 'width' => 20],
    ['label' => 'Alamat', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

$config = [
    'data' => $users->map(function ($user) use ($btnEdit, $btnDelete, $btnDetails) {
        return [
            $user->id_user,
            $user->nama,
            $user->email,
            $user->alamat,
            '<nobr>'. $btnEdit . $btnDelete . $btnDetails .'</nobr>',
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

{{-- Compressed with style options / fill data using the plugin config --}}

@endsection
