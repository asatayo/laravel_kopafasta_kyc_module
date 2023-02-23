<?php

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
