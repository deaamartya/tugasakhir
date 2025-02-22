<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Laboratorium
 * 
 * @property int $ID_LABORATORIUM
 * @property string $NAMA_LABORATORIUM
 * 
 * @property Collection|KatalogBahan[] $katalog_bahans
 * @property Collection|KategoriAlat[] $kategori_alats
 * @property Collection|Lemari[] $lemaris
 * @property Collection|Praktikum[] $praktikums
 * @property Collection|RuangLaboratorium[] $ruang_laboratoria
 *
 * @package App\Models
 */
class Laboratorium extends Model
{
	protected $table = 'laboratorium';
	protected $primaryKey = 'ID_LABORATORIUM';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_LABORATORIUM'
	];

	public function katalog_bahans()
	{
		return $this->hasMany(KatalogBahan::class, 'ID_LABORATORIUM');
	}

	public function kategori_alats()
	{
		return $this->hasMany(KategoriAlat::class, 'ID_LABORATORIUM');
	}

	public function lemaris()
	{
		return $this->hasMany(Lemari::class, 'ID_LABORATORIUM');
	}

	public function praktikums()
	{
		return $this->hasMany(Praktikum::class, 'ID_LABORATORIUM');
	}

	public function ruang_laboratorium()
	{
		return $this->hasMany(RuangLaboratorium::class, 'ID_LABORATORIUM');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'ID_LABORATORIUM');
	}

	public function lab()
	{
		return substr(strstr($this->NAMA_LABORATORIUM," "), 1);
	}

	public function mata_pelajarans()
	{
		return $this->hasMany(MataPelajaran::class, 'ID_LABORATORIUM');
	}
}
