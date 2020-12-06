<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $ID_USER
 * @property int $ID_TIPE_USER
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $PATH_FOTO
 * 
 * @property TipeUser $tipe_user
 * @property Collection|Kela[] $kelas
 * @property Collection|PerubahanJadwalPeminjaman[] $perubahan_jadwal_peminjamen
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'ID_USER';
	public $timestamps = false;

	protected $casts = [
		'ID_TIPE_USER' => 'int'
	];

	protected $fillable = [
		'ID_TIPE_USER',
		'USERNAME',
		'PASSWORD',
		'PATH_FOTO'
	];

	public function tipe_user()
	{
		return $this->belongsTo(TipeUser::class, 'ID_TIPE_USER');
	}

	public function kelas()
	{
		return $this->hasMany(Kela::class, 'ID_USER');
	}

	public function perubahan_jadwal_peminjamen()
	{
		return $this->hasMany(PerubahanJadwalPeminjaman::class, 'ID_USER');
	}
}
