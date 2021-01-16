<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kelas
 * 
 * @property string $ID_KELAS
 * @property int $ID_TAHUN_AKADEMIK
 * @property int $ID_USER
 * @property int $ID_JENIS_KELAS
 * 
 * @property TahunAkademik $tahun_akademik
 * @property User $user
 * @property JenisKela $jenis_kela
 * @property Collection|Praktikum[] $praktikums
 *
 * @package App\Models
 */
class Kelas extends Model
{
	protected $table = 'kelas';
	protected $primaryKey = 'ID_KELAS';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_TAHUN_AKADEMIK' => 'int',
		'ID_USER' => 'int',
		'ID_JENIS_KELAS' => 'int'
	];

	protected $fillable = [
		'ID_TAHUN_AKADEMIK',
		'ID_USER',
		'ID_JENIS_KELAS',
		'ID_MAPEL'
	];

	public function tahun_akademik()
	{
		return $this->belongsTo(TahunAkademik::class, 'ID_TAHUN_AKADEMIK');
	}

	public function guru()
	{
		return $this->belongsTo(User::class, 'ID_USER');
	}

	public function jenis_kelas()
	{
		return $this->belongsTo(JenisKelas::class, 'ID_JENIS_KELAS');
	}

	public function praktikums()
	{
		return $this->hasMany(Praktikum::class, 'ID_KELAS');
	}

	public function mapel()
	{
		return $this->belongsTo(MataPelajaran::class, 'ID_MAPEL');
	}
}
