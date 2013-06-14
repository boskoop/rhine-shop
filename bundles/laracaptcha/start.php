<?php

Autoloader::map(array(
	'LaraCaptcha\\Captcha' => __DIR__.DS.'classes'.DS.'captcha.php',
));

Laravel\Validator::register('laracaptcha', function($attribute, $value, $parameters)
{
	return LaraCaptcha\Captcha::check($value);
});