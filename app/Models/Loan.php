<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'amount',
        'interest_rate',
        'duration',
        'start_date',
        'total_payable',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function repayments()
{
    return $this->hasMany(Repayment::class);
}

}
