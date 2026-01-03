<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h2>Edit Customer</h2>

<form method="POST" action="{{ route('customers.update', $customer->id) }}">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $customer->name }}"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ $customer->email }}"><br><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" value="{{ $customer->phone }}"><br><br>

    <label>Address:</label><br>
    <textarea name="address">{{ $customer->address }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
