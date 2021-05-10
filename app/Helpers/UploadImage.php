<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class UploadImage
{
	protected static $image, $file, $path, $unlink, $ext, $name;

	public static function setImage($image)
	{
		self::$image = $image;
	}

	// public static function setFile($file)
	// {
	// 	self::$file = $file;
	// }

	public static function setPath($path)
	{
		self::$path = $path;
	}

	public static function setUnlink($unlink)
	{
		self::$unlink = $unlink;
	}

	public static function setExt($ext)
	{
		self::$ext = $ext;
	}

	public static function setName($name)
	{
		self::$name = $name;
	}

    public static function uploadImage()
    {
    	$ext  = 'png';
        $file = self::$image;
        $path = self::$path . '/' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 30) . '.' . $ext;

        Storage::disk('custom-s3')->put($path, $file, [
			'visibility' => 'public',
		]);

		return $path;
    }

}
