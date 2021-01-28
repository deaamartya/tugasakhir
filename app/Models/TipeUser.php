<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipeUser
 * 
 * @property int $ID_TIPE_USER
 * @property string $NAMA_TIPE_USER
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class TipeUser extends Model
{
	protected $table = 'tipe_user';
	protected $primaryKey = 'ID_TIPE_USER';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_TIPE_USER'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'ID_TIPE_USER');
	}
}
