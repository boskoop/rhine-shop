<?php
/**
 * LaraCaptcha
 *
 * Captcha package for the Laravel framework.
 * (c) 2012 Vlad Rusu (vlad.rusu@gmail.com)
 * Based on Fuel-Captcha (c) 2011 Mikhail Khasaya, Kruglov Sergei
 *
 * @package		LaraCaptcha
 * @version		1.0
 * @author		Vlad Rusu
 * @license		MIT License (see LICENSE for more info)
 * @copyright	2011-2012 Mikhail Khasaya, Kruglov Sergei, Vlad Rusu
 */


namespace LaraCaptcha;

class Captcha {

	// These properties are loaded from [bundle]\config\captcha.php
	// You can change their values there
	// They are loaded on the first generate request
	// Do not set any defaults here, they will be overridden

	public static $alphabet;
	public static $allowed_symbols;
	public static $fonts_dir;
	public static $length;
	public static $width;
	public static $height;
	public static $fluctuation_amplitude;
	public static $no_spaces;
	public static $show_credits;
	public static $foreground_color;
	public static $background_color;
	public static $jpeg_quality;

	// Config array
	protected static $config;

	/**
	 * We don't have class constructor, as all is static
	 *
	 * @param	void
	 * @access	private
	 * @return	void
	 */
	final private function __construct() {}

	/**
	 * Loads in the config and sets the variables
	 *
	 * @access	protected
	 * @return	void
	 */
	protected static function loadconfig()
	{
		// load the config
		static::$config = \Config::get('laracaptcha::config');

		// update the defaults with the configed values
		foreach(static::$config as $key => $value)
		{
			static::${$key} = $value;
			//print_r($value);
		}
	}

	/**
	 * Checks if the supplied captcha test value matches the stored one
	 *
	 * @param	string	$value
	 * @access	public
	 * @return	bool
	 */
	public static function check($value)
	{
		$session_captcha_hash = \Session::get('session_captcha_hash', null);

		return $value != null && $session_captcha_hash != null && \Hash::check($value, $session_captcha_hash);
	}

	/**
	 * Returns an URL to the captcha image
	 * For example, you can use in your view something like
	 * <img src="<?php echo Captcha\Captcha::img(); ?>" alt="" />
	 *
	 * @access	public
	 * @return	string
	 */
	public static function img() {
		return \URL::to('captcha?'.mt_rand(1, 100000)); //add a random number to avoid browser caching issues
	}

	/**
	 * Generates a captcha image, writing it to the output
	 * It is used internally by this bundle when pointing to "/captcha" (see [bundle]\routes.php)
	 * Typically, you won't use this function, but use the above img() function instead
	 *
	 * @access	public
	 * @return	void
	 */
	public static function generate()
	{
		if (!isset(static::$config)) static::loadconfig();

		$fonts = array();

		//Get avaliable fonts
		foreach (glob(static::$fonts_dir.'*.png') as $filename)
		{
			$fonts[]= $filename;
		}

		$alphabet_length = strlen(static::$alphabet);

		do
		{
			// generating random keystring
			$keystring = '';
			for($i=0; $i < static::$length; $i++)
			{
				$keystring .= static::$allowed_symbols[mt_rand(0, strlen(static::$allowed_symbols) - 1)];
			}

			//Save to session
			\Session::put('session_captcha_hash', \Hash::make($keystring));

			$font_file = $fonts[mt_rand(0, count($fonts) - 1)];
			$font = imagecreatefrompng($font_file);
			imagealphablending($font, true);
			$fontfile_width = imagesx($font);
			$fontfile_height = imagesy($font) - 1;
			$font_metrics = array();
			$symbol = 0;
			$reading_symbol = false;

			// loading font
			for($i=0; $i < $fontfile_width && $symbol < $alphabet_length; $i++)
			{
				$transparent = (imagecolorat($font, $i, 0) >> 24) == 127;

				if(!$reading_symbol && !$transparent)
				{
					$font_metrics[static::$alphabet[$symbol]] = array('start' => $i);
					$reading_symbol = true;
					continue;
				}

				if($reading_symbol && $transparent)
				{
					$font_metrics[static::$alphabet[$symbol]]['end'] = $i;
					$reading_symbol = false;
					$symbol++;
					continue;
				}
			}


			$img = imagecreatetruecolor(static::$width, static::$height);
			imagealphablending($img, true);
			$white = imagecolorallocate($img, 255, 255, 255);
			$black = imagecolorallocate($img, 0, 0, 0);

			imagefilledrectangle($img, 0, 0, static::$width - 1, static::$height - 1, $white);

			// draw text
			$x=1;
			for($i=0; $i < static::$length; $i++)
			{
				$m = $font_metrics[$keystring[$i]];

				$y = mt_rand(-static::$fluctuation_amplitude, static::$fluctuation_amplitude) + (static::$height - $fontfile_height) / 2 + 2;

				if(static::$no_spaces)
				{
					$shift = 0;
					if($i > 0)
					{
						$shift = 10000;
						for($sy = 7; $sy < $fontfile_height - 20; $sy+=1)
						{
							for($sx = $m['start'] - 1; $sx < $m['end']; $sx+=1)
							{
				        		$rgb = imagecolorat($font, $sx, $sy);
				        		$opacity = $rgb >> 24;
								if($opacity < 127)
								{
									$left = $sx - $m['start'] + $x;
									$py = $sy + $y;
									if($py>static::$height) break;
									for($px = min($left, static::$width - 1); $px > $left - 12 && $px >=0; $px-=1)
									{
						        		$color = imagecolorat($img, $px, $py) & 0xff;
										if($color + $opacity < 190)
										{
											if($shift > $left - $px)
											{
												$shift = $left - $px;
											}
											break;
										}
									}
									break;
								}
							}
						}
						if($shift == 10000)
						{
							$shift=mt_rand(4, 6);
						}

					}
				}
				else
				{
					$shift = 1;
				}
				imagecopy($img, $font, $x-$shift, $y, $m['start'], 1, $m['end'] - $m['start'], $fontfile_height);
				$x+=$m['end']-$m['start']-$shift;
			}
		} while($x >= static::$width - 10); // while not fit in canvas

		$center = $x / 2;

		// credits. To remove, see configuration file
		$img2 = imagecreatetruecolor(static::$width, static::$height + (static::$show_credits ? 12 : 0));
		$foreground=imagecolorallocate($img2, static::$foreground_color[0], static::$foreground_color[1], static::$foreground_color[2]);
		$background=imagecolorallocate($img2, static::$background_color[0], static::$background_color[1], static::$background_color[2]);
		imagefilledrectangle($img2, 0, 0, static::$width - 1, static::$height - 1, $background);
		imagefilledrectangle($img2, 0, static::$height, static::$width - 1, static::$height + 12, $foreground);
		$credits = $_SERVER['HTTP_HOST'];
		imagestring($img2, 2, static::$width / 2 - imagefontwidth(2) * strlen($credits) / 2, static::$height - 2, $credits, $background);

		// periods
		$rand1 = mt_rand(750000, 1200000) / 10000000;
		$rand2 = mt_rand(750000, 1200000) / 10000000;
		$rand3 = mt_rand(750000, 1200000) / 10000000;
		$rand4 = mt_rand(750000, 1200000) / 10000000;
		// phases
		$rand5 = mt_rand(0, 31415926) / 10000000;
		$rand6 = mt_rand(0, 31415926) / 10000000;
		$rand7 = mt_rand(0, 31415926) / 10000000;
		$rand8 = mt_rand(0, 31415926) / 10000000;
		// amplitudes
		$rand9 = mt_rand(330, 420) / 110;
		$rand10 = mt_rand(330, 450) / 110;

		//wave distortion

		for($x = 0; $x < static::$width; $x++)
		{
			for($y = 0; $y < static::$height; $y++)
			{
				$sx=$x + (sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6)) * $rand9 - static::$width / 2 + $center + 1;
				$sy=$y + (sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8)) * $rand10;

				if($sx < 0 || $sy < 0 || $sx >= static::$width - 1 || $sy >= static::$height - 1)
				{
					continue;
				}
				else
				{
					$color = imagecolorat($img, $sx, $sy) & 0xFF;
					$color_x = imagecolorat($img, $sx+1, $sy) & 0xFF;
					$color_y = imagecolorat($img, $sx, $sy+1) & 0xFF;
					$color_xy = imagecolorat($img, $sx+1, $sy+1) & 0xFF;
				}

				if($color == 255 && $color_x == 255 && $color_y == 255 && $color_xy == 255)
				{
					continue;
				}
				else if($color == 0 && $color_x == 0 && $color_y == 0 && $color_xy == 0)
				{
					$newred = static::$foreground_color[0];
					$newgreen = static::$foreground_color[1];
					$newblue = static::$foreground_color[2];
				}
				else
				{
					$frsx = $sx - floor($sx);
					$frsy = $sy - floor($sy);
					$frsx1 = 1 - $frsx;
					$frsy1 = 1 - $frsy;

					$newcolor = (
						$color * $frsx1 * $frsy1 +
						$color_x * $frsx * $frsy1 +
						$color_y * $frsx1 * $frsy +
						$color_xy * $frsx * $frsy
					);

					if($newcolor > 255) $newcolor = 255;
					$newcolor = $newcolor / 255;
					$newcolor0 = 1 - $newcolor;

					$newred = $newcolor0 * static::$foreground_color[0] + $newcolor * static::$background_color[0];
					$newgreen = $newcolor0 * static::$foreground_color[1] + $newcolor * static::$background_color[1];
					$newblue=$newcolor0 * static::$foreground_color[2] + $newcolor * static::$background_color[2];
				}

				imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
			}
		}

		// Set no cache
		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Pragma: no-cache');

		if(function_exists('imagejpeg'))
		{
			header('Content-Type: image/jpeg');
			imagejpeg($img2, null, static::$jpeg_quality);
		}
		else if(function_exists('imagegif'))
		{
			header('Content-Type: image/gif');
			imagegif($img2);
		}
		else if(function_exists('imagepng'))
		{
			header('Content-Type: image/x-png');
			imagepng($img2);
		}
	}
}