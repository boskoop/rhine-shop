<?php

Route::get('captcha', function()
{
	LaraCaptcha\Captcha::generate();
});