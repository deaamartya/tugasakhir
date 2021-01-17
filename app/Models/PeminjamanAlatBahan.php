<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

	public function ruang_laboratorium()
	{
		return $this->belongsTo(RuangLaboratorium::class, 'ID_RUANG_LABORATORIUM');
	}

	public function perubahan_jadwal_peminjamen()
	{
		return $this->hasMany(PerubahanJadwalPeminjaman::class, 'ID_PEMINJAMAN');
	}
}
