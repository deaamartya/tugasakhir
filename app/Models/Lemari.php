<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lemari
 * 
 * @property int $ID_LEMARI
 * @property int $ID_LABORATORIUM
 * @property string $NAMA_LEMARI
 * 
 * @property Laboratorium $laboratorium
 * @property Collection|Alat[] $alats
 * @property Collection|Bahan[] $bahans
 * @property Collection|BahanKimium[] $bahan_kimia
 *
 * @package App\Models
 */
class Lemari extends Model
{
	protected $table = 'lemari';
	protected $primaryKey = 'ID_LEMARI';
	public $timestamps = false;

	protected $casts = [
		'ID_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_LABORATORIUM',
		'NAMA_LEMARI'
	];

	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function alats()
	{
		return $this->hasMany(Alat::class, 'ID_LEMARI');
	}

	public function bahans()
	{
		return $this->hasMany(Bahan::class, 'ID_LEMARI');
	}

	public function bahan_kimia()
	{
		return $this->hasMany(BahanKimium::class, 'ID_LEMARI');
	}
}
