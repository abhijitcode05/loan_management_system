@extends('layouts.app')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<!-- Summary Cards -->
<div class="row mb-4">
    <!-- Total Loans -->
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Loans</h5>
                <p class="card-text fs-4">{{ $loans->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Total Paid -->
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Paid</h5>
                <p class="card-text fs-4">
                    ₹{{ $loans->sum(fn($loan) => $loan->repayments->sum('amount_paid')) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Remaining Amount -->
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Remaining</h5>
                <p class="card-text fs-4">
                    ₹{{ $loans->sum(fn($loan) => $loan->total_payable - $loan->repayments->sum('amount_paid')) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Completed Loans -->
    <div class="col-md-3">
        <div class="card text-white bg-secondary mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Completed Loans</h5>
                <p class="card-text fs-4">
                    {{ $loans->where('status', 'completed')->count() }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- All Loans Grid -->
<h2 class="mb-4">All Loans</h2>

<div class="row">
    @foreach($loans as $loan)
        <div class="col-md-4">
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    Loan #{{ $loan->id }} - {{ $loan->customer->name }}
                </div>
                <div class="card-body">
                    <p><strong>Principal:</strong> ₹{{ $loan->amount }}</p>
                    <p><strong>Total Payable:</strong> ₹{{ $loan->total_payable }}</p>
                    <p><strong>Total Paid:</strong> ₹{{ $loan->repayments->sum('amount_paid') }}</p>
                    <p><strong>Remaining:</strong> ₹{{ $loan->total_payable - $loan->repayments->sum('amount_paid') }}</p>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge {{ $loan->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </p>
                    <a href="{{ route('repayments.index', $loan->id) }}" class="btn btn-info btn-sm">View / Add EMI</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
