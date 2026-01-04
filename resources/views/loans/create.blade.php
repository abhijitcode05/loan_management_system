@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Create Loan</h5>
                </div>

                <div class="card-body">

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('loans.store') }}">
                        @csrf

                        <!-- Customer -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Customer</label>
                            <select name="customer_id" class="form-select" required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Loan Amount -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Loan Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter loan amount" required>
                        </div>

                        <!-- Interest Rate -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Interest Rate (% per month)</label>
                            <input type="number" step="0.01" name="interest_rate" class="form-control" placeholder="e.g. 10" required>
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Duration (months)</label>
                            <input type="number" name="duration" class="form-control" placeholder="e.g. 12" required>
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-4">
                                Create Loan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
