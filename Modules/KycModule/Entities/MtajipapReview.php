<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class  MtajipapReview extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\MtajipapReviewFactory::new();
    }


    public function step()
    {
      return $this->belongsTo('Modules\KycModule\Entities\Step', 'step_id');
    }




}
