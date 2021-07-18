<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alat
 * 
 * @property string $ID_ALAT
 * @property string $ID_KATALOG_ALAT
 * @property int $ID_LEMARI
 * @property int $ID_MERK_TIPE
 * @property string $UKURAN
 * @property int $JUMLAH_BAGUS
 * @property int $JUMLAH_RUSAK
 * 
 * @property KatalogAlat $katalog_alat
 * @property Lemari $lemari
 * @property MerkTipeAlat $merk_tipe_alat
 *
 * @package App\Models
 */
class Alat extends Model
{
	protected $table = 'alat';
	protected $primaryKey = 'ID_ALAT';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_LEMARI' => 'int',
		'ID_MERK_TIPE' => 'int',
	];

	protected $fillable = [
		'ID_KATALOG_ALAT',
		'ID_LEMARI',
		'ID_MERK_TIPE',
	];

	public function katalog_alat()
	{
		return $this->belongsTo(KatalogAlat::class, 'ID_KATALOG_ALAT');
	}

	public function lemari()
	{
		return $this->belongsTo(Lemari::class, 'ID_LEMARI');
	}

	public function merk_tipe_alat()
	{
		return $this->belongsTo(MerkTipeAlat::class, 'ID_MERK_TIPE');
	}

	public function stok_bagus()
	{
		$stok = self::join('histori_stok as h','h.ID_ALAT_BAHAN','=','alat.ID_ALAT')->where('h.ID_ALAT_BAHAN','=',$this->ID_ALAT)->where('h.KONDISI','=',1)->where('ID_TIPE','=',1)->orderBy('h.TIMESTAMP','DESC')->limit(1)->value('STOK');
		return ($stok < 1) ? 0 : $stok;
	}

	public function stok_rusak()
	{
		$stok = self::join('histori_stok as h','h.ID_ALAT_BAHAN','=','alat.ID_ALAT')->where('h.ID_ALAT_BAHAN','=',$this->ID_ALAT)->where('h.KONDISI','=',0)->where('ID_TIPE','=',1)->orderBy('h.TIMESTAMP','DESC')->limit(1)->value('STOK');
		return ($stok < 1) ? 0 : $stok;
	}

	public function kerusakan(){
		return $this->hasMany(KerusakanAlat::class, 'ID_ALAT');
	}
}
