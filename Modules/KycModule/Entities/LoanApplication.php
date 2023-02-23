<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_product_id','loan_applicant_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanApplicationFactory::new();
    }


    public  function applicant()
    {
      return $this->belongsTo('Modules\KycModule\Entities\LoanApplicant');
    }
}
