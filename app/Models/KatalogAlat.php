<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KatalogAlat
 * 
 * @property string $ID_KATALOG_ALAT
 * @property int $ID_KATEGORI_ALAT
 * @property string $NAMA_ALAT
 * 
 * @property KategoriAlat $kategori_alat
 * @property Collection|Alat[] $alats
 *
 * @package App\Models
 */
class KatalogAlat extends Model
{
	protected $table = 'katalog_alat';
	protected $primaryKey = 'ID_KATALOG_ALAT';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_KATEGORI_ALAT' => 'int'
	];

	protected $fillable = [
		'ID_KATALOG_ALAT',
		'ID_KATEGORI_ALAT',
		'NAMA_ALAT',
		'UKURAN'
	];

	public function kategori_alat()
	{
		return $this->belongsTo(KategoriAlat::class, 'ID_KATEGORI_ALAT');
	}

	public function alats()
	{
		return $this->hasMany(Alat::class, 'ID_KATALOG_ALAT');
	}
}
