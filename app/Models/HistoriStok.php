<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoriStok
 * 
 * @property string $ID_HISTORI
 * @property int $ID_TIPE
 * @property string|null $ID_ALAT_BAHAN
 * @property Carbon $TIMESTAMP
 * @property int $JUMLAH_MASUK
 * @property int $JUMLAH_KELUAR
 * @property bool|null $KONDISI
 * @property int $STOK
 * @property string|null $KETERANGAN
 * 
 * @property Tipe $tipe
 *
 * @package App\Models
 */
class HistoriStok extends Model
{
	protected $table = 'histori_stok';
	protected $primaryKey = 'ID_HISTORI';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_TIPE' => 'int',
		'JUMLAH_MASUK' => 'float',
		'JUMLAH_KELUAR' => 'float',
		'KONDISI' => 'bool',
		'STOK' => 'float'
	];

	protected $dates = [
		'TIMESTAMP' => 'datetime:Y-m-d H:i:s'
	];

	protected $fillable = [
		'ID_TIPE',
		'ID_ALAT_BAHAN',
		'ID_TRANSAKSI',
		'TIMESTAMP',
		'JUMLAH_MASUK',
		'JUMLAH_KELUAR',
		'KONDISI',
		'KETERANGAN'
	];

	public function tipe()
	{
		return $this->belongsTo(Tipe::class, 'ID_TIPE');
	}
}
