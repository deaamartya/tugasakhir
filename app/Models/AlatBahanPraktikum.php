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
		'JUMLAH',
		'ID_ALAT_BAHAN',
		'ID_PRAKTIKUM'
	];

	public function praktikum()
	{
		return $this->belongsTo(Praktikum::class, 'ID_PRAKTIKUM');
	}

	public function tipe()
	{
		return $this->belongsTo(Tipe::class, 'ID_TIPE');
	}

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'ID_ALAT_BAHAN');
	}

	public function bahan()
	{
		return $this->belongsTo(Bahan::class, 'ID_ALAT_BAHAN');
	}

	public function bahan_kimia()
	{
		return $this->belongsTo(BahanKimia::class, 'ID_ALAT_BAHAN');
	}
}
