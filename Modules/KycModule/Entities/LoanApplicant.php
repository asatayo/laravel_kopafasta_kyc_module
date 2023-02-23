<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanApplicant extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanApplicantFactory::new();
    }

    public  function applications()
    {
      return $this->hasMany('Modules\KycModule\Entities\LoanApplication', 'loan_product_id');
    }
}
