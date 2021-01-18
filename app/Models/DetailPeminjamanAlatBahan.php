<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjamanAlatBahan extends Model
{
    protected $table = 'detail_peminjaman_alat_bahan';

	protected $casts = [
		'JUMLAH' => 'int',
	];

	protected $fillable = [
		'ID_PEMINJAMAN',
		'ID_ALAT_BAHAN',
        'JUMLAH_PINJAM',
        'ID_TIPE'
	];

	public function peminjaman_alat_bahan()
	{
		return $this->belongsTo(PeminjamanAlatBahan::class, 'ID_PEMINJAMAN');
	}
    
    public function alat()
	{
		return $this->belongsTo(Alat::class, 'ID_ALAT_BAHAN');
	}

	public function bahan()
	{
		return $this->belongsTo(Bahan::class, 'ID_ALAT_BAHAN');
	}

	public function bahan_kimia()
	{
		return $this->belongsTo(BahanKimia::class, 'ID_ALAT_BAHAN');
	}
}
