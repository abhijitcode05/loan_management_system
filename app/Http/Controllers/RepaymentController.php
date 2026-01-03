<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function index(Loan $loan)
    {
        $totalPaid = (float) $loan->repayments()->sum('amount_paid');
        $totalPayable = (float) $loan->total_payable;
        $remaining = round($totalPayable - $totalPaid, 2);

        // Reconcile database status with actual payments
        if ($totalPaid >= $totalPayable && $loan->status !== 'completed') {
            $loan->update(['status' => 'completed']);
        } elseif ($totalPaid < $totalPayable && $loan->status === 'completed') {
            // In case records were changed (repayment deleted/rolled back), reopen loan
            $loan->update(['status' => 'active']);
        }

        return view('repayments.index', compact(
            'loan',
            'totalPaid',
            'remaining',
            'totalPayable'
        ));
    }

    public function store(Request $request, Loan $loan)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
        ]);

        if ($loan->status !== 'active') {
            return redirect()->back()->withErrors(['loan' => 'Loan already completed']);
        }

        $totalPaidBefore = $loan->repayments()->sum('amount_paid');
        $remaining = $loan->total_payable - $totalPaidBefore;

        if ($request->amount_paid > $remaining) {
            return redirect()->back()->withErrors(['amount_paid' => 'Payment exceeds remaining amount (₹'.number_format($remaining, 2).')']);
        }

        Repayment::create([
            'loan_id' => $loan->id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
        ]);

        // Auto close loan
        $totalPaid = $loan->repayments()->sum('amount_paid');
        if ($totalPaid >= $loan->total_payable) {
            $loan->update(['status' => 'completed']);
        }

        return redirect()->back()->with('success', 'Payment added successfully');
    }
}
