<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\KycModule\Entities\Category;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\StepFactory::new();
    }

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
      return $this->belongsTo('Modules\KycModule\Entities\Category', 'category_id');
    }
}
