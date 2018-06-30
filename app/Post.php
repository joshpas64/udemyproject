<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Cviebrock\EloquentSluggable\SluggableInterface;
//use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
 use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    use Sluggable;
    //use SluggableTrait;
    use SluggableScopeHelpers;

    // protected $sluggable = [
    // 	'build_from' => 'title',
    // 	'save_to'    => 'slug',
    // 	'on_update'  => true,
    // 	'onUpdate'   => true
    // ];

	protected $fillable = [
		'title',
		'body',
		'user_id',
		'category_id',
		'photo_id'
	];

	public function sluggable(){
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}
	
	public function category(){
		return $this->belongsTo('App\Category');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function photo(){
		return $this->belongsTo('App\Photo');
	}

	public function comments(){
		return $this->hasMany('App\Comment');
	}
}
