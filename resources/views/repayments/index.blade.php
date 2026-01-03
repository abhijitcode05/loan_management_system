@extends('layouts.app')

@section('content')

<h2 class="mb-4">Loan EMI Page</h2>

<!-- Loan Summary Card -->
<div class="card mb-3 shadow-sm">
    <div class="card-header bg-primary text-white">Loan Summary</div>
    <div class="card-body">
        <p><strong>Principal:</strong> ₹{{ $loan->amount }}</p>
        <p><strong>Total Payable:</strong> ₹{{ $loan->total_payable }}</p>
        <p><strong>Total Paid:</strong> ₹{{ $totalPaid }}</p>
        <p><strong>Remaining:</strong> ₹{{ $remaining }}</p>
        <p>
            <strong>Status:</strong>
            <span class="badge {{ $loan->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                {{ ucfirst($loan->status) }}
            </span>
        </p>
    </div>
</div>

<!-- Add EMI Card -->
<div class="card mb-3 shadow-sm">
    <div class="card-header bg-info text-white">Add EMI</div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('repayments.store', $loan->id) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">EMI Amount</label>
                <input type="number" name="amount_paid" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Payment Date</label>
                <input type="date" name="payment_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add EMI</button>
        </form>
    </div>
</div>

<!-- Payment History Table -->
<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">Payment History</div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loan->repayments as $repayment)
                    <tr>
                        <td>{{ $repayment->payment_date }}</td>
                        <td>{{ $repayment->amount_paid }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No payments yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
