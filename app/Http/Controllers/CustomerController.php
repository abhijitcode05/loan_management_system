<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required',
            'address' => 'nullable'
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
                         ->with('success', 'Customer added successfully');
    }
    public function edit($id)
{
    $customer = Customer::findOrFail($id);
    return view('customers.edit', compact('customer'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:customers,email,' . $id,
        'phone' => 'required',
        'address' => 'nullable'
    ]);

    $customer = Customer::findOrFail($id);
    $customer->update($request->all());

    return redirect()->route('customers.index')
                     ->with('success', 'Customer updated successfully');
}

public function destroy($id)
{
    Customer::findOrFail($id)->delete();

    return redirect()->route('customers.index')
                     ->with('success', 'Customer deleted successfully');
}


}
