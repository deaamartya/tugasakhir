<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KategoriAlat
 * 
 * @property int $ID_KATEGORI_ALAT
 * @property int $ID_LABORATORIUM
 * @property string $NAMA_KATEGORI
 * 
 * @property Laboratorium $laboratorium
 * @property Collection|KatalogAlat[] $katalog_alats
 *
 * @package App\Models
 */
class KategoriAlat extends Model
{
	protected $table = 'kategori_alat';
	protected $primaryKey = 'ID_KATEGORI_ALAT';
	public $timestamps = false;

	protected $casts = [
		'ID_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_LABORATORIUM',
		'NAMA_KATEGORI'
	];

	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function katalog_alats()
	{
		return $this->hasMany(KatalogAlat::class, 'ID_KATEGORI_ALAT');
	}
}
