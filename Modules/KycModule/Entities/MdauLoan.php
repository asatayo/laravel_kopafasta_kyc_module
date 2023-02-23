<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\KycModule\Entities\MdauReview;
use Modules\KycModule\Entities\Step;

use App\Models\User;
use Auth;


class MdauLoan extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = [
      'is_reviewed','reviews', 'unreviewed','is_bottom_reviewed','reviewer_name',
    ];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\MdauLoanFactory::new();
    }

    public function customer()
    {
      return $this->belongsTo('Modules\KycModule\Entities\Customer', 'customer_id');
    }

    public function guarators()
    {
      return $this->hasMany('Modules\KycModule\Entities\MdauLoanGuarantorPerson', 'mdau_id');
    }

    public function other_debts()
    {
      return $this->hasMany('Modules\KycModule\Entities\MdauLoanOtherDebts', 'mdau_id');
    }




    public function getIsReviewedAttribute()
    {

      $admin =   Auth::guard('admin')->user();



      return !MdauReview::where('user_id', $admin->id)->where('mdau_id', $this->id)->where('is_reviewed', 0)->exists();



    }
    public function getReviewsAttribute()
    {

      $admin =   Auth::guard('admin')->user();

      return MdauReview::where('user_id', $admin->id)->where('mdau_id', $this->id)->get();

    }

    public function getUnreviewedAttribute()
    {

      $admin =   Auth::guard('admin')->user();

      return MdauReview::where('user_id', $admin->id)->where('mdau_id', $this->id)->where('is_reviewed', 0)->get();

    }



    public function getIsBottomReviewedAttribute(){



       $admin =   Auth::guard('admin')->user();

       $isReviewed = MdauReview::where('mdau_id', $this->id)->where('user_id', $admin->id)->where('step_id', $this->current_step)->where('is_reviewed', 0)->exists();

        return $isReviewed;


    }

    public function getReviewerNameAttribute(){


        $step = Step::where('id', $this->current_step)->first();


         if(!empty($step)){
           $name = User::where('id', $step->user_id)->first();
         }else{
           $name = Auth::guard('admin')->user();
         }

       return $name;

    }




}
