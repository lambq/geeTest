<?php
Route::get('/captcha', function () {
    $captcha = app('captcha');

    echo $captcha->GTServerIsNormal();
});