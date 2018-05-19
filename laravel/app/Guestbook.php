<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;


class Guestbook extends Model {

	// use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'guestbook';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'message'];

	
	
}
