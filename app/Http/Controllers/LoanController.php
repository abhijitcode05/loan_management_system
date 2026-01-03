<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Customer;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('customer')->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('loans.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'   => 'required|exists:customers,id',
            'amount'        => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'duration'      => 'required|integer|min:1',
            'start_date'    => 'required|date'
        ]);

        // Simple Interest Formula (monthly rate, duration in months)
        $principal = (float) $request->amount;
        $rate = (float) $request->interest_rate; // percent per month
        $duration = (int) $request->duration; // months

        $totalPayable = round($principal + ($principal * $rate * $duration / 100), 2);

        Loan::create([
            'customer_id'   => $request->customer_id,
            'amount'        => $request->amount,
            'interest_rate' => $request->interest_rate,
            'duration'      => $request->duration,
            'start_date'    => $request->start_date,
            'total_payable' => $totalPayable,
            'status'        => 'active'
        ]);

        return redirect()->route('loans.index')
                         ->with('success', 'Loan created successfully');
    }
}
