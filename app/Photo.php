<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $fillable = ['file'];
	
	protected $uploads = '/images/';

	private static $_uploadDir = 'images';	

	public function getFileAttribute($photo){
		return $this->uploads . $photo;
	}

	public function getUploadDir(){
		return $uploads;
	}

	public static function getPhotoDir(){
		return self::$_uploadDir;
	}

	public static function getPlaceHolder(){
		return 'http://placehold.it/900x300';
	}

    //
    //
}
