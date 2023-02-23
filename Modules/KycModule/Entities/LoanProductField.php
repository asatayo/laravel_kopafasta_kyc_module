<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanProductField extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name', 'field_type', 'loan_product_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanProductFieldFactory::new();
    }
}
