<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanApplicationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id', 'loan_product_field_id', 'data',
    ];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanApplicationDetailFactory::new();
    }
}
