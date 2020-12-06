<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AlatBahanPraktikum
 * 
 * @property int $ID_TIPE
 * @property string $ID_PRAKTIKUM
 * @property string $ID_ALAT_BAHAN
 * @property int $JUMLAH
 * 
 * @property Praktikum $praktikum
 * @property Tipe $tipe
 *
 * @package App\Models
 */
class AlatBahanPraktikum extends Model
{
	protected $table = 'alat_bahan_praktikum';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_TIPE' => 'int',
		'JUMLAH' => 'int'
	];

	protected $fillable = [
		'ID_TIPE',
		'JUMLAH'
	];

	public function praktikum()
	{
		return $this->belongsTo(Praktikum::class, 'ID_PRAKTIKUM');
	}

	public function tipe()
	{
		return $this->belongsTo(Tipe::class, 'ID_TIPE');
	}
}
