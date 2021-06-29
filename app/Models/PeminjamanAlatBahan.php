<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoriStok;
use App\Models\Alat;

/**
 * Class PeminjamanAlatBahan
 * 
 * @property int $ID_PEMINJAMAN
 * @property int $ID_RUANG_LABORATORIUM
 * @property string $ID_PRAKTIKUM
 * @property Carbon $TANGGAL_PEMINJAMAN
 * @property string $STATUS_PEMINJAMAN
 * 
 * @property Praktikum $praktikum
 * @property RuangLaboratorium $ruang_laboratorium
 * @property Collection|PerubahanJadwalPeminjaman[] $perubahan_jadwal_peminjamen
 *
 * @package App\Models
 */
class PeminjamanAlatBahan extends Model
{
	protected $table = 'peminjaman_alat_bahan';
	protected $primaryKey = 'ID_PEMINJAMAN';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_RUANG_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_RUANG_LABORATORIUM',
		'ID_KELAS',
		'ID_PRAKTIKUM',
		'TANGGAL_PEMINJAMAN',
		'STATUS_PEMINJAMAN',
		'JAM_MULAI',
		'JAM_SELESAI'
	];

	public function praktikum()
	{
		return $this->belongsTo(Praktikum::class, 'ID_PRAKTIKUM');
	}

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'ID_KELAS');
	}

	public function ruang_laboratorium()
	{
		return $this->belongsTo(RuangLaboratorium::class, 'ID_RUANG_LABORATORIUM');
	}

	public function perubahan_jadwal_peminjamen()
	{
		return $this->hasOne(PerubahanJadwalPeminjaman::class, 'ID_PEMINJAMAN');
	}

	public static function alat_peminjaman($id_peminjaman)
	{
		$histori_stok = HistoriStok::where('ID_TIPE',1)->where('ID_TRANSAKSI',$id_peminjaman)->where('KONDISI',1)->where('JUMLAH_MASUK',0)->get();
		$data = [];
		foreach($histori_stok as $h)
		{
			$obj = new \StdClass();
			$obj->alat = Alat::where('ID_ALAT','=',$h->ID_ALAT_BAHAN)->first();
			$obj->JUMLAH_PINJAM = $h->JUMLAH_KELUAR;
			$data[] = $obj;
		}
		return $data;
	}

	public static function bahan_peminjaman($id_peminjaman)
	{
		$histori_stok = HistoriStok::where('ID_TIPE',2)->where('ID_TRANSAKSI',$id_peminjaman)->where('JUMLAH_MASUK',0)->get();
		$data = [];
		foreach($histori_stok as $h)
		{
			$obj = new \StdClass();
			$obj->bahan = Bahan::where('ID_BAHAN','=',$h->ID_ALAT_BAHAN)->first();
			$obj->JUMLAH_PINJAM = $h->JUMLAH_KELUAR;
			$data[] = $obj;
		}
		return $data;
	}

	public static function bahan_kimia_peminjaman($id_peminjaman)
	{
		$histori_stok = HistoriStok::where('ID_TIPE',3)->where('ID_TRANSAKSI',$id_peminjaman)->where('JUMLAH_MASUK',0)->get();
		$data = [];
		foreach($histori_stok as $h)
		{
			$obj = new \StdClass();
			$obj->bahan_kimia = BahanKimia::where('ID_BAHAN_KIMIA','=',$h->ID_ALAT_BAHAN)->first();
			$obj->JUMLAH_PINJAM = $h->JUMLAH_KELUAR;
			$data[] = $obj;
		}
		return $data;
	}
}
