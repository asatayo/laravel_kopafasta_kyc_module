<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MdauLoanOtherDebts extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\MdauLoanOtherDebtsFactory::new();
    }
}
