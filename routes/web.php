<?php
Route::group(['prefix' => 'api', 'middleware' => 'signed'],
    function() {
    Route::get('email/verify/{id}', 'Auth\VerificationApiController@verify')->name('verificationapi.verify');
});
