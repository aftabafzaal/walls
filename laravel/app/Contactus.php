<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;


class Contactus extends Model {

	// use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contactus';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['cu_name', 'cu_email', 'cu_desc'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['cu_token'];
	
	
}
