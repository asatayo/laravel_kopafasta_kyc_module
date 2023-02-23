<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\KycModule\Entities\StepCategory;
use Modules\KycModule\Entities\Step;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'maximum',
      'minimum',
      'description',
    ];

  protected  $appends = [
      'steps'
    ];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\LoanFactory::new();
    }

    public function getStepsAttribute()
    {

      $category = $this->id;

      $step_category_ids = StepCategory::where('category_id', $category)->get()->pluck('step_id');
      return Step::with('user')->whereIn('id', $step_category_ids)->get();
    }
}
