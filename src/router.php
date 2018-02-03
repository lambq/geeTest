<?php
Route::post('/verify', function () {
    $captcha = app('captcha');
    if ($captcha->isFromGTServer()) {
        if($captcha->success()){
            return 'success';
        }
        return 'no';
    }
    if ($captcha->hasAnswer()) {
        return "answer";
    }
    return "no answer";
});

Route::get('/captcha', function () {
    $captcha = app('captcha');

    echo $captcha->GTServerIsNormal();
});