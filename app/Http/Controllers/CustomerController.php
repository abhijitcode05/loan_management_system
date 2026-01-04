<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Show only customers for the logged-in user
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->get();
        return view('customers.index', compact('customers'));
    }

    // Show form to create a new customer
    public function create()
    {
        return view('customers.create');
    }

    // Store a new customer
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email',
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Customer::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    // Edit customer
    public function edit(Customer $customer)
    {
        $this->authorizeCustomer($customer);
        return view('customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        $this->authorizeCustomer($customer);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email,' . $customer->id,
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer->update($request->only([
            'name',
            'email',
            'phone',
            'address',
        ]));

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        $this->authorizeCustomer($customer);

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    // Authorization helper
    private function authorizeCustomer(Customer $customer): void
    {
        if ($customer->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
