<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KerusakanAlat
 * 
 * @property string $ID_KERUSAKAN
 * @property string $ID_KELAS
 * @property string $KETERANGAN_RUSAK
 * @property bool $STATUS
 * 
 * @property Kela $kela
 *
 * @package App\Models
 */
class KerusakanAlat extends Model
{
	protected $table = 'kerusakan_alat';
	protected $primaryKey = 'ID_KERUSAKAN';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'STATUS' => 'bool'
	];

	protected $fillable = [
		'ID_KELAS',
		'KETERANGAN_RUSAK',
		'STATUS',
		'ID_PEMINJAMAN',
		'ID_ALAT',
	];

	public function kelas()
	{
		return $this->belongsTo(Kelas::class, 'ID_KELAS');
	}

	public function peminjaman()
	{
		return $this->belongsTo(PeminjamanAlatBahan::class, 'ID_PEMINJAMAN');
	}

	public function alat()
	{
		return $this->belongsTo(Alat::class, 'ID_ALAT');
	}
}
