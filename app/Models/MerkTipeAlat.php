<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MerkTipeAlat
 * 
 * @property int $ID_MERK_TIPE
 * @property string $NAMA_MERK_TIPE
 * 
 * @property Collection|Alat[] $alats
 *
 * @package App\Models
 */
class MerkTipeAlat extends Model
{
	protected $table = 'merk_tipe_alat';
	protected $primaryKey = 'ID_MERK_TIPE';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_MERK_TIPE'
	];

	public function alats()
	{
		return $this->hasMany(Alat::class, 'ID_MERK_TIPE');
	}
}
