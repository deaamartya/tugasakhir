<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;

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
		$data = [];
		$list_katalog = self::select('ka.*')
		->join('alat as a','a.ID_LEMARI','lemari.ID_LEMARI')
		->join('katalog_alat as ka','ka.ID_KATALOG_ALAT','a.ID_KATALOG_ALAT')
		->where('lemari.ID_LEMARI','=',$id)->groupBy('ka.ID_KATALOG_ALAT')->get();
		foreach($list_katalog as $l){
			$obj = new \StdClass();
			$obj->ID_KATALOG_ALAT = $l->ID_KATALOG_ALAT;
			$obj->NAMA_ALAT = $l->NAMA_ALAT;
			$obj->UKURAN = $l->UKURAN;
			$list_alat = Alat::where('ID_KATALOG_ALAT','=',$l->ID_KATALOG_ALAT)->get();
			$jml_bagus = 0;
			$jml_rusak = 0;
			foreach($list_alat as $a){
				$jml_bagus = $jml_bagus + $a->stok_bagus();
				$jml_rusak = $jml_rusak + $a->stok_rusak();
			}
			$obj->JUMLAH_BAGUS = $jml_bagus;
			$obj->JUMLAH_RUSAK = $jml_rusak;
			$data[] = $obj;
		}
		return $data;
	}

	public static function katalog_bahan($id)
	{
		$list_bahan = Bahan::select('*')
		->join('lemari','bahan.ID_LEMARI','lemari.ID_LEMARI')
		->where('lemari.ID_LEMARI','=',$id)->get();
		$data = [];

		foreach($list_bahan as $b){
			$obj = new \StdClass();
			$obj->ID_BAHAN = $b->ID_BAHAN;
			$obj->NAMA_BAHAN = $b->NAMA_BAHAN;
			$obj->JUMLAH = $b->stok();
			$data[] = $obj;
		}
		return $data;
	}

	public static function katalog_bahan_kimia($id)
	{
		$list_bahan = BahanKimia::select('*')
		->join('lemari','bahan_kimia.ID_LEMARI','lemari.ID_LEMARI')
		->where('lemari.ID_LEMARI','=',$id)->get();
		$data = [];

		foreach($list_bahan as $b){
			$obj = new \StdClass();
			$obj->ID_BAHAN_KIMIA = $b->ID_BAHAN_KIMIA;
			$obj->NAMA_BAHAN_KIMIA = $b->NAMA_BAHAN_KIMIA;
			$obj->RUMUS = $b->RUMUS;
			$obj->SPESIFIKASI_BAHAN = $b->SPESIFIKASI_BAHAN;
			$obj->WUJUD = $b->WUJUD;
			$obj->JUMLAH_BAHAN_KIMIA = $b->stok();
			$data[] = $obj;
		}
		return $data;
	}
}
