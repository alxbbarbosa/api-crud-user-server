<?php
Route::group(['namespace' => 'Auth'],
    function() {
    Route::post('login', 'LoginApiController@authenticate')->name('users.authenticate');
    Route::post('register', 'LoginApiController@register')->name('users.register');
    Route::get('email/resend', 'VerificationApiController@resend')->name('users.email-resend');
});

Route::group(['middleware' => ['auth:api', 'verified'], 'namespace' => 'Auth'],
    function() {
    Route::get('logout', 'LoginApiController@logout');
});

Route::group(['middleware' => ['auth:api', 'verified'], 'namespace' => 'Api\v1'],
    function() {
    Route::apiResource('users', 'UserCOntroller');
    Route::put('users/{id}/change-password', 'UserCOntroller@updatePassword')->name('users.change-password');
});
