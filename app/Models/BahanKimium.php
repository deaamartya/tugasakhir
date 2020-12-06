<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BahanKimium
 * 
 * @property string $ID_BAHAN_KIMIA
 * @property string $ID_KATALOG_BAHAN
 * @property int $ID_LEMARI
 * @property string $NAMA_BAHAN_KIMIA
 * @property string $RUMUS
 * @property string $WUJUD
 * @property float $JUMLAH_BAHAN_KIMIA
 * @property bool $SPESIFIKASI_BAHAN
 * 
 * @property KatalogBahan $katalog_bahan
 * @property Lemari $lemari
 *
 * @package App\Models
 */
class BahanKimium extends Model
{
	protected $table = 'bahan_kimia';
	protected $primaryKey = 'ID_BAHAN_KIMIA';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_LEMARI' => 'int',
		'JUMLAH_BAHAN_KIMIA' => 'float',
		'SPESIFIKASI_BAHAN' => 'bool'
	];

	protected $fillable = [
		'ID_KATALOG_BAHAN',
		'ID_LEMARI',
		'NAMA_BAHAN_KIMIA',
		'RUMUS',
		'WUJUD',
		'JUMLAH_BAHAN_KIMIA',
		'SPESIFIKASI_BAHAN'
	];

	public function katalog_bahan()
	{
		return $this->belongsTo(KatalogBahan::class, 'ID_KATALOG_BAHAN');
	}

	public function lemari()
	{
		return $this->belongsTo(Lemari::class, 'ID_LEMARI');
	}
}
