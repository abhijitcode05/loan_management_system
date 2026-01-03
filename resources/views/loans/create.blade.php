<!DOCTYPE html>
<html>
<head>
    <title>Create Loan</title>
</head>
<body>

<h2>Create Loan</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('loans.store') }}">
    @csrf

    <label>Customer:</label><br>
    <select name="customer_id">
        <option value="">Select Customer</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select><br><br>

    <label>Loan Amount:</label><br>
    <input type="number" name="amount"><br><br>

    <label>Interest Rate (% per month):</label><br>
    <input type="number" step="0.01" name="interest_rate"><br><br>

    <label>Duration (months):</label><br>
    <input type="number" name="duration"><br><br>

    <label>Start Date:</label><br>
    <input type="date" name="start_date"><br><br>

    <button type="submit">Create Loan</button>
</form>

</body>
</html>
