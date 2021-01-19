<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerubahanJadwalPeminjaman
 * 
 * @property int $ID_PERUBAHAN_JADWAL
 * @property int $ID_PEMINJAMAN
 * @property int $ID_USER
 * @property Carbon $TANGGAL_LAMA
 * @property Carbon $TANGGAL_BARU
 * @property string $PESAN
 * @property bool $STATUS_PERUBAHAN
 * 
 * @property User $user
 * @property PeminjamanAlatBahan $peminjaman_alat_bahan
 *
 * @package App\Models
 */
class PerubahanJadwalPeminjaman extends Model
{
	protected $table = 'perubahan_jadwal_peminjaman';
	protected $primaryKey = 'ID_PERUBAHAN_JADWAL';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_USER' => 'int',
		'STATUS_PERUBAHAN' => 'bool'
	];

	protected $fillable = [
		'ID_PEMINJAMAN',
		'ID_USER',
		'TANGGAL_BARU',
		'JAM_MULAI_BARU',
		'JAM_SELESAI_BARU',
		'PESAN',
		'STATUS_PERUBAHAN'
	];

	public function guru()
	{
		return $this->belongsTo(User::class, 'ID_USER');
	}

	public function peminjaman_alat_bahan()
	{
		return $this->belongsTo(PeminjamanAlatBahan::class, 'ID_PEMINJAMAN');
	}
}
