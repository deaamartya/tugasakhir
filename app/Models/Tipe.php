<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipe
 * 
 * @property int $ID_TIPE
 * @property string $NAMA_TIPE
 * 
 * @property Collection|AlatBahanPraktikum[] $alat_bahan_praktikums
 * @property Collection|HistoriStok[] $histori_stoks
 *
 * @package App\Models
 */
class Tipe extends Model
{
	protected $table = 'tipe';
	protected $primaryKey = 'ID_TIPE';
	public $timestamps = false;

	protected $fillable = [
		'NAMA_TIPE'
	];

	public function alat_bahan_praktikums()
	{
		return $this->hasMany(AlatBahanPraktikum::class, 'ID_TIPE');
	}

	public function histori_stoks()
	{
		return $this->hasMany(HistoriStok::class, 'ID_TIPE');
	}
}
