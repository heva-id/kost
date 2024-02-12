@extends('layouts.backend.app')

@section('title', 'Pengeluaran')

@section('content')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pengeluaran
                    <a href="{{route('expenses.create')}}" class="btn btn-primary btn-sm">Tambah Pengeluaran</a>
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th class="text-nowrap">Deskripsi</th>
                                        <th class="text-nowrap">Jumlah</th>
                                        <th class="text-nowrap">Tanggal</th>
                                        <th class="text-nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('d-F-Y') }}</td>
                                        <td>
                                            {{-- Tambahkan tombol atau link aksi di sini --}}
                                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
