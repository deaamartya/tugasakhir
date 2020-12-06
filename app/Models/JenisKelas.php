<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JenisKelas
 * 
 * @property int $ID_JENIS_KELAS
 * @property string $NAMA_JENIS_KELAS
 * 
 * @property Collection|Kela[] $kelas
 *
 * @package App\Models
 */
class JenisKelas extends Model
{
	protected $table = 'jenis_kelas';
	protected $primaryKey = 'ID_JENIS_KELAS';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_JENIS_KELAS'
	];

	public function kelas()
	{
		return $this->hasMany(Kelas::class, 'ID_JENIS_KELAS');
	}
}
