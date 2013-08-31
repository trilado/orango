<?php

class Image
{
	public static function get($path, $w, $h)
	{
		$filename = 'tmp/' . md5($path . $w . $h . Config::get('salt')) . '.png';

		if(!file_exists(WWWROOT . $filename))
		{
			$canvas = new canvas();
			$canvas->carrega($path);
			$canvas->redimensiona($w, $h, 'crop');
			$canvas->grava(WWWROOT . $filename);
		}

		return $filename;
	}
}