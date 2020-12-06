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
 * @property string $NAMA_PRAKTIKUM
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

	protected $casts = [
		'ID_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_LABORATORIUM',
		'ID_MAPEL',
		'ID_KELAS',
		'NAMA_PRAKTIKUM'
	];

	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function mata_pelajaran()
	{
		return $this->belongsTo(MataPelajaran::class, 'ID_MAPEL');
	}

	public function kela()
	{
		return $this->belongsTo(Kela::class, 'ID_KELAS');
	}

	public function alat_bahan_praktikums()
	{
		return $this->hasMany(AlatBahanPraktikum::class, 'ID_PRAKTIKUM');
	}

	public function peminjaman_alat_bahans()
	{
		return $this->hasMany(PeminjamanAlatBahan::class, 'ID_PRAKTIKUM');
	}
}
