<?php

namespace Tests\Feature;

use App\Models\Loan;
use App\Models\Repayment;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_overpay_loan()
    {
        $customer = Customer::factory()->create();

        $loan = Loan::create([
            'customer_id' => $customer->id,
            'amount' => 100,
            'interest_rate' => 2,
            'duration' => 2,
            'start_date' => now()->toDateString(),
            'total_payable' => 104.00,
            'status' => 'active'
        ]);

        $response = $this->post(route('repayments.store', $loan->id), [
            'amount_paid' => 200,
            'payment_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('amount_paid');
        $this->assertCount(0, $loan->repayments);
    }

    public function test_payment_marks_loan_completed_when_paid_in_full()
    {
        $customer = Customer::factory()->create();

        $loan = Loan::create([
            'customer_id' => $customer->id,
            'amount' => 100,
            'interest_rate' => 2,
            'duration' => 2,
            'start_date' => now()->toDateString(),
            'total_payable' => 104.00,
            'status' => 'active'
        ]);

        $this->post(route('repayments.store', $loan->id), [
            'amount_paid' => 104.00,
            'payment_date' => now()->toDateString(),
        ]);

        $this->assertSame('completed', $loan->fresh()->status);
    }

    public function test_completed_loan_cannot_accept_payments()
    {
        $customer = Customer::factory()->create();

        $loan = Loan::create([
            'customer_id' => $customer->id,
            'amount' => 100,
            'interest_rate' => 2,
            'duration' => 2,
            'start_date' => now()->toDateString(),
            'total_payable' => 104.00,
            'status' => 'completed'
        ]);

        $response = $this->post(route('repayments.store', $loan->id), [
            'amount_paid' => 10,
            'payment_date' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('loan');
        $this->assertCount(0, $loan->repayments);
    }
}
