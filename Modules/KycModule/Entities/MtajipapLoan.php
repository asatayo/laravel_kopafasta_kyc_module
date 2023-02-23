<?php

namespace Modules\KycModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\KycModule\Entities\MtajipapReview;
use App\Models\User;

use Auth;

class MtajipapLoan extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $appends = [
      'is_reviewed','reviews', 'unreviewed','is_bottom_reviewed','reviewer_name',
    ];

    protected static function newFactory()
    {
        return \Modules\KycModule\Database\factories\MtajipapLoanFactory::new();
    }

    public function customer()
    {
      return $this->belongsTo('Modules\KycModule\Entities\Customer', 'customer_id');
    }

    public function guarators()
    {
      return $this->hasMany('Modules\KycModule\Entities\MtajipapLoanGuarantorPerson', 'mtajipap_id');
    }

    public function other_debts()
    {
      return $this->hasMany('Modules\KycModule\Entities\MtajipapLoanOtherDebts', 'mtajipap_id');
    }




    public function getIsReviewedAttribute()
    {

      $admin =   Auth::guard('admin')->user();



      return !MtajipapReview::where('user_id', $admin->id)->where('mtajipap_id', $this->id)->where('is_reviewed', 0)->exists();



    }
    public function getReviewsAttribute()
    {

      $admin =   Auth::guard('admin')->user();

      return MtajipapReview::where('user_id', $admin->id)->where('mtajipap_id', $this->id)->get();

    }

    public function getUnreviewedAttribute()
    {

      $admin =   Auth::guard('admin')->user();

      return MtajipapReview::where('user_id', $admin->id)->where('mtajipap_id', $this->id)->where('is_reviewed', 0)->get();

    }



    public function getIsBottomReviewedAttribute(){


      //Add authenticated user here
      $admin =   Auth::guard('admin')->user();

      $steps = Category::where('id', 1)->get();

       $isReviewed = true;

       foreach ($steps as $step) {

          $isItemAvailable = MtajipapReview::where('mtajipap_id', $this->id)->where('step_id', $step->id)->where('magnitude', '!=', 1)->where('is_reviewed', 0)->exists();

              if($isItemAvailable){
                 $isReviewed =  false;
                   break;
              }else{
                   $isReviewed =  true;
              }

       }

       return $isReviewed;

    }

    public function getReviewerNameAttribute(){

      //Add authenticated user here

      $admin =   Auth::guard('admin')->user();
      $name = $admin;

       $isReviewed = true;

      $steps = Category::where('id', 1)->get();

       foreach ($steps as $step) {

          $isItemAvailable = MtajipapReview::where('mtajipap_id', $this->id)->where('step_id', $step->id)->where('magnitude', '!=', 1)->where('is_reviewed', 0)->exists();

              if($isItemAvailable){
                      $isReviewed =  false;
                      $name = User::where('id', $step->id)->first();
                      break;
              }

       }

       return $name;

    }




}
