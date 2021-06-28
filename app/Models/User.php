<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
// use NotificationChannels\WebPush\HasPushSubscriptions;
class User extends Authenticatable
{
	use Notifiable;
	// use HasPushSubscriptions;
	protected $table = 'users';
	protected $primaryKey = 'ID_USER';
	public $timestamps = false;

	protected $casts = [
		'ID_TIPE_USER' => 'int',
		'ONLINE' => 'bool'
	];

	protected $fillable = [
		'ID_TIPE_USER',
		'username',
		'password',
		'PATH_FOTO',
		'NAMA_LENGKAP',
		'ID_LABORATORIUM',
		'ONLINE'
	];

	public function tipe_user()
	{
		return $this->belongsTo(TipeUser::class, 'ID_TIPE_USER');
	}
	
	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function kelas()
	{
		return $this->hasMany(Kelas::class, 'ID_USER');
	}

	public function perubahan_jadwal_peminjamen()
	{
		return $this->hasMany(PerubahanJadwalPeminjaman::class, 'ID_USER');
	}

	public static function guru(){
		return self::join('tipe_user as t','t.ID_TIPE_USER','=','users.ID_TIPE_USER')->where('t.NAMA_TIPE_USER','LIKE','%Guru%')->get();
	}
}
