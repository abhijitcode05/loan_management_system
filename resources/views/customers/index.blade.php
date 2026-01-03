<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
</head>
<body>

<h2>Customer List</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ route('customers.create') }}">Add New Customer</a>

<table border="1" cellpadding="10">
    <th>Actions</th>

    @foreach($customers as $customer)
<tr>
    <td>{{ $customer->id }}</td>
    <td>{{ $customer->name }}</td>
    <td>{{ $customer->email }}</td>
    <td>{{ $customer->phone }}</td>
    <td>{{ $customer->address }}</td>
    <td>
        <a href="{{ route('customers.edit', $customer->id) }}">Edit</a>

        <form action="{{ route('customers.destroy', $customer->id) }}"
              method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach


</table>

</body>
</html>
