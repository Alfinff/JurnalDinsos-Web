<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use File;

class UploadFile
{
	protected static $image, $file, $path, $unlink, $ext, $name;

	// public static function setImage($image)
	// {
	// 	self::$image = $image;
	// }

	public static function setFile($file)
	{
		self::$file = $file;
	}

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

    public static function uploadFile()
    {
    	$ext  = self::$ext;
        $file = self::$file;
        $path = self::$path . '/' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 15) . '.' . $ext;

        Storage::disk('custom-s3')->put($path, $file, [
			'visibility' => 'public',
		]);

		return $path;
    }

}
