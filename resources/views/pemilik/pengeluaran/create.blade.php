<!-- resources/views/expenses/create.blade.php -->

@extends('layouts.backend.app')
@section('title',isset($expense) ? 'Ubah Pengeluaran' : 'Buat Pengeluaran Baru')
@section('content')
<section id="basic-vertical-layouts">
    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($expense) ? 'Edit' : 'Create' }} Expense
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">


                        <!-- resources/views/expenses/create.blade.php -->

                        @if (isset($expense))
                        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                            @method('PUT')
                            @else
                            <form action="{{ route('expenses.store') }}" method="POST">
                                @endif

                                @csrf

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input type="text" name="description" class="form-control" value="{{ isset($expense) ? $expense->description : '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="number" name="amount" class="form-control" value="{{ isset($expense) ? $expense->amount : '' }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" name="date" class="form-control" value="{{ isset($expense) ? $expense->date : '' }}" required>
                                </div>

                                {{-- Assuming you have authentication and each expense belongs to a user --}}
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                <button type="submit" class="btn btn-primary">{{ isset($expense) ? 'Update' : 'Submit' }}</button>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
