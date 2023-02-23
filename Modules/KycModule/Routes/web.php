<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('kycmodule')->group(function() {
      Route::get('/', 'Customer\KycModuleAuthenticationController@phone_form');
      Route::get('/action', 'Customer\KycModuleActionController@index');
      Route::post('storeData', 'Customer\KycModuleActionController@store')->name('storeData');
      Route::get('show/{application}', 'Customer\KycModuleActionController@show');

      Route::get('/start', 'Customer\KycModuleAuthenticationController@phone_form');
      Route::post('addPhone', 'Customer\KycModuleAuthenticationController@addPhone')->name('addPhone');
      Route::get('/verify', 'Customer\KycModuleAuthenticationController@verify');
      Route::post('verifyOtp', 'Customer\KycModuleAuthenticationController@verifyOtp')->name('verifyOtp');


//Authenticated customer
     Route::group(['middleware' => 'auth:customer'], function () {

              Route::get('profile', 'Customer\KycModuleProfileController@form');
              Route::post('uploadProfile', 'Customer\KycModuleProfileController@uploadProfile')->name('uploadProfile');

              Route::get('personal-details', 'Customer\KycModuleCustomerController@customer_form');
              Route::post('addCustomer', 'Customer\KycModuleCustomerController@addCustomer')->name('addCustomer');


              Route::get('home', 'Customer\KycModuleHomeController@home');



              //Customer
              Route::get('loans', 'Customer\KycModuleLoanCategoryController@categories');
              Route::post('chooseLoan', 'Customer\KycModuleLoanCategoryController@chooseLoan')->name('chooseLoan');





              //Ndinga loan
              Route::get('loan/ndinga/{loan}/step-one', 'Ndinga\KycModuleNdingaLoanController@step_one_form');
              Route::post('ndingaLoanOne', 'Ndinga\KycModuleNdingaLoanController@ndingaLoanOne')->name('ndingaLoanOne');

              Route::get('loan/ndinga/{loan}/step-two', 'Ndinga\KycModuleNdingaLoanController@step_two_form');
              Route::post('ndingaLoanTwo', 'Ndinga\KycModuleNdingaLoanController@ndingaLoanTwo')->name('ndingaLoanTwo');
              Route::get('loan/ndinga/debt-delete/{loan}/{debt}', 'Ndinga\KycModuleNdingaLoanController@delete_debt');



              Route::get('loan/ndinga/{loan}/step-three', 'Ndinga\KycModuleNdingaLoanController@step_three_form');
              Route::post('ndingaLoanThree', 'Ndinga\KycModuleNdingaLoanController@ndingaLoanThree')->name('ndingaLoanThree');
              Route::get('loan/ndinga/guarator-delete/{loan}/{guarator}', 'Ndinga\KycModuleNdingaLoanController@delete_guarantor');



              Route::get('loan/ndinga/{loan}/step-four', 'Ndinga\KycModuleNdingaLoanController@step_four_form');
              Route::post('ndingaLoanFour', 'Ndinga\KycModuleNdingaLoanController@ndingaLoanFour')->name('ndingaLoanFour');
              Route::get('loan/ndinga/{loan}/terms', 'Ndinga\KycModuleNdingaLoanController@terms');
              Route::get('loan/ndinga/{loan}/finish', 'Ndinga\KycModuleNdingaLoanController@finish');






              //Mtajipap loan
              // Route::get('loan/mtajipap/{loan}/step-one', 'Mtajipap\KycModuleMtajipapLoanController@step_one_form');
              // Route::post('ndingaLoanOne', 'Mtajipap\KycModuleMtajipapLoanController@ndingaLoanOne')->name('ndingaLoanOne');
              //
              // Route::get('loan/mtajipap/{loan}/step-two', 'Mtajipap\KycModuleMtajipapLoanController@step_two_form');
              // Route::post('ndingaLoanTwo', 'Mtajipap\KycModuleMtajipapLoanController@ndingaLoanTwo')->name('ndingaLoanTwo');
              // Route::get('loan/mtajipap/debt-delete/{loan}/{debt}', 'Mtajipap\KycModuleMtajipapLoanController@delete_debt');
              //
              //
              //
              // Route::get('loan/mtajipap/{loan}/step-three', 'Mtajipap\KycModuleMtajipapLoanController@step_three_form');
              // Route::post('ndingaLoanThree', 'Mtajipap\KycModuleMtajipapLoanController@ndingaLoanThree')->name('ndingaLoanThree');
              // Route::get('loan/mtajipap/guarator-delete/{loan}/{guarator}', 'Mtajipap\KycModuleMtajipapLoanController@delete_guarantor');
              //
              //
              //
              // Route::get('loan/mtajipap/{loan}/step-four', 'Mtajipap\KycModuleMtajipapLoanController@step_four_form');
              // Route::post('ndingaLoanFour', 'Mtajipap\KycModuleMtajipapLoanController@ndingaLoanFour')->name('ndingaLoanFour');
              // Route::get('loan/mtajipap/{loan}/terms', 'Mtajipap\KycModuleMtajipapLoanController@terms');
              // Route::get('loan/mtajipap/{loan}/finish', 'Mtajipap\KycModuleMtajipapLoanController@finish');






              //Mtajipap loan
              Route::get('loan/mtajipap/{loan}/step-one', 'Mtajipap\KycModuleMtajipapLoanController@step_one_form');
              Route::post('mtajipapLoanOne', 'Mtajipap\KycModuleMtajipapLoanController@mtajipapLoanOne')->name('mtajipapLoanOne');

              Route::get('loan/mtajipap/{loan}/step-two', 'Mtajipap\KycModuleMtajipapLoanController@step_two_form');
              Route::post('mtajipapLoanTwo', 'Mtajipap\KycModuleMtajipapLoanController@mtajipapLoanTwo')->name('mtajipapLoanTwo');
              Route::get('loan/mtajipap/debt-delete/{loan}/{debt}', 'Mtajipap\KycModuleMtajipapLoanController@delete_debt');



              Route::get('loan/mtajipap/{loan}/step-three', 'Mtajipap\KycModuleMtajipapLoanController@step_three_form');
              Route::post('mtajipapLoanThree', 'Mtajipap\KycModuleMtajipapLoanController@mtajipapLoanThree')->name('mtajipapLoanThree');
              Route::get('loan/mtajipap/guarator-delete/{loan}/{guarator}', 'Mtajipap\KycModuleMtajipapLoanController@delete_guarantor');



              Route::get('loan/mtajipap/{loan}/step-four', 'Mtajipap\KycModuleMtajipapLoanController@step_four_form');
              Route::post('mtajipapLoanFour', 'Mtajipap\KycModuleMtajipapLoanController@mtajipapLoanFour')->name('mtajipapLoanFour');
              Route::get('loan/mtajipap/{loan}/terms', 'Mtajipap\KycModuleMtajipapLoanController@terms');
              Route::get('loan/mtajipap/{loan}/finish', 'Mtajipap\KycModuleMtajipapLoanController@finish');






              //Mdau loan
              Route::get('loan/mdau/{loan}/step-one', 'Mdau\KycModuleMdauLoanController@step_one_form');
              Route::post('mdauLoanOne', 'Mdau\KycModuleMdauLoanController@mdauLoanOne')->name('mdauLoanOne');

              Route::get('loan/mdau/{loan}/step-two', 'Mdau\KycModuleMdauLoanController@step_two_form');
              Route::post('mdauLoanTwo', 'Mdau\KycModuleMdauLoanController@mdauLoanTwo')->name('mdauLoanTwo');
              Route::get('loan/mdau/debt-delete/{loan}/{debt}', 'Mdau\KycModuleMdauLoanController@delete_debt');



              Route::get('loan/mdau/{loan}/step-three', 'Mdau\KycModuleMdauLoanController@step_three_form');
              Route::post('mdauLoanThree', 'Mdau\KycModuleMdauLoanController@mdauLoanThree')->name('mdauLoanThree');
              Route::get('loan/mdau/guarator-delete/{loan}/{guarator}', 'Mdau\KycModuleMdauLoanController@delete_guarantor');



              Route::get('loan/mdau/{loan}/step-four', 'Mdau\KycModuleMdauLoanController@step_four_form');
              Route::post('mdauLoanFour', 'Mdau\KycModuleMdauLoanController@mdauLoanFour')->name('mdauLoanFour');
              Route::get('loan/mdau/{loan}/terms', 'Mdau\KycModuleMdauLoanController@terms');
              Route::get('loan/mdau/{loan}/finish', 'Mdau\KycModuleMdauLoanController@finish');




     });


     Route::get('admin/login', 'Admin\KycModuleAdminAuthController@login');
     Route::get('admin/logout', 'Admin\KycModuleAdminAuthController@logout');

     Route::post('adminLogin', 'Admin\KycModuleAdminAuthController@adminLogin')->name('adminLogin');

     Route::group(['middleware' => 'auth:admin'], function () {

          //Administrator
          Route::get('admin/home', 'Admin\KycModuleAdminDashboardController@index');



          Route::get('add-step', 'Admin\KycModuleAdminStepsController@step_form');
          Route::post('addStep', 'Admin\KycModuleAdminStepsController@addStep')->name('addStep');
          Route::get('steps', 'Admin\KycModuleAdminStepsController@steps');
          Route::get('step/delete/{id}', 'Admin\KycModuleAdminStepsController@delete');




          //loans
          Route::get('create-loan-package', 'Admin\KycModuleAdminLoanCategoryController@category_form');
          Route::post('addCategory', 'Admin\KycModuleAdminLoanCategoryController@addCategory')->name('addCategory');
          Route::post('deleteCategory', 'Admin\KycModuleAdminLoanCategoryController@deleteCategory')->name('deleteCategory');



          //Mtajipap loan
          Route::get('admin/pending/ndinga', 'Admin\KycModuleAdminNdingaLoanController@ndinga');
          Route::get('admin/ndinga/review/{loan}', 'Admin\KycModuleAdminNdingaLoanController@review');
          Route::get('admin/ndinga/more/{loan}', 'Admin\KycModuleAdminNdingaLoanController@more');

          Route::post('ndingaReview', 'Admin\KycModuleAdminNdingaLoanController@ndingaReview')->name('ndingaReview');



          //mtajipap loan
          // Route::get('admin/pending/mtajipap', 'Admin\KycModuleAdminMtajipapLoanController@categories');
          Route::get('admin/pending/mtajipap', 'Admin\KycModuleAdminMtajipapLoanController@mtajipap');
          Route::get('admin/mtajipap/review/{loan}', 'Admin\KycModuleAdminMtajipapLoanController@review');
          Route::get('admin/mtajipap/more/{loan}', 'Admin\KycModuleAdminMtajipapLoanController@more');


          Route::post('mtajipapReview', 'Admin\KycModuleAdminMtajipapLoanController@mtajipapReview')->name('mtajipapReview');




          //process loans
          //mdau loan
          Route::get('admin/pending/mdau', 'Admin\KycModuleAdminMdauLoanController@mdau');
          Route::get('admin/mdau/review/{loan}', 'Admin\KycModuleAdminMdauLoanController@review');
          Route::get('admin/mdau/more/{loan}', 'Admin\KycModuleAdminMdauLoanController@more');

          Route::post('mdauReview', 'Admin\KycModuleAdminMdauLoanController@mdauReview')->name('mdauReview');



     });
});
