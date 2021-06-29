<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Praktikum
 * 
 * @property string $ID_PRAKTIKUM
 * @property int $ID_LABORATORIUM
 * @property string $ID_MAPEL
 * @property string $ID_KELAS
 * @property string $JUDUL_PRAKTIKUM
 * 
 * @property Laboratorium $laboratorium
 * @property MataPelajaran $mata_pelajaran
 * @property Kela $kela
 * @property Collection|AlatBahanPraktikum[] $alat_bahan_praktikums
 * @property Collection|PeminjamanAlatBahan[] $peminjaman_alat_bahans
 *
 * @package App\Models
 */
class Praktikum extends Model
{
	protected $table = 'praktikum';
	protected $primaryKey = 'ID_PRAKTIKUM';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'ID_MAPEL',
		'JUDUL_PRAKTIKUM'
	];

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class, 'ID_MAPEL');
	}

	public function alat_bahan_praktikum()
	{
		return $this->hasMany(AlatBahanPraktikum::class, 'ID_PRAKTIKUM');
	}

	public function peminjaman_alat_bahan()
	{
		return $this->hasMany(PeminjamanAlatBahan::class, 'ID_PRAKTIKUM');
	}

	public function alat_praktikum()
	{
		return AlatBahanPraktikum::where('ID_PRAKTIKUM','=',$this->ID_PRAKTIKUM)->where('ID_TIPE','=',1)->get();
	}

	public function bahan_praktikum()
	{
		return AlatBahanPraktikum::where('ID_PRAKTIKUM','=',$this->ID_PRAKTIKUM)->where('ID_TIPE','=',2)->get();
	}

	public function bahan_kimia_praktikum()
	{
		return AlatBahanPraktikum::where('ID_PRAKTIKUM','=',$this->ID_PRAKTIKUM)->where('ID_TIPE','=',3)->get();
	}
}
