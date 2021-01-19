<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DB;

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
		return $this->hasMany(BahanKimia::class, 'ID_LEMARI');
	}

	public static function katalog_alats($id)
	{
		$katalogs = self::select('ka.*',DB::raw('SUM(a.JUMLAH_BAGUS) AS JUMLAH_BAGUS'),DB::raw('SUM(a.JUMLAH_RUSAK) AS JUMLAH_RUSAK'))
		->join('alat as a','a.ID_LEMARI','lemari.ID_LEMARI')
		->join('katalog_alat as ka','ka.ID_KATALOG_ALAT','a.ID_KATALOG_ALAT')
		->where('lemari.ID_LEMARI','=',$id)->groupBy('ka.ID_KATALOG_ALAT')->get();
		return $katalogs;
	}

	public static function katalog_bahan($id)
	{
		return self::select('a.*',DB::raw('SUM(a.JUMLAH) AS JUMLAH'))
		->join('bahan as a','a.ID_LEMARI','lemari.ID_LEMARI')
		->where('lemari.ID_LEMARI','=',$id)->get();
	}

	public static function katalog_bahan_kimia($id)
	{
		return self::select('a.*','kb.*')
		->join('bahan_kimia as a','a.ID_LEMARI','lemari.ID_LEMARI')
		->join('katalog_bahan as kb','kb.ID_KATALOG_BAHAN','a.ID_KATALOG_BAHAN')
		->where('lemari.ID_LEMARI','=',$id)->get();
	}
}
