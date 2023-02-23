<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name', 'field_type'
    ];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanProductFactory::new();
    }
}
