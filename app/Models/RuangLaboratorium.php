<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RuangLaboratorium
 * 
 * @property int $ID_RUANG_LABORATORIUM
 * @property int $ID_LABORATORIUM
 * @property string $NAMA_RUANG_LABORATORIUM
 * 
 * @property Laboratorium $laboratorium
 * @property Collection|PeminjamanAlatBahan[] $peminjaman_alat_bahans
 *
 * @package App\Models
 */
class RuangLaboratorium extends Model
{
	protected $table = 'ruang_laboratorium';
	protected $primaryKey = 'ID_RUANG_LABORATORIUM';
	public $timestamps = false;

	protected $casts = [
		'ID_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_LABORATORIUM',
		'NAMA_RUANG_LABORATORIUM'
	];

	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function peminjaman_alat_bahans()
	{
		return $this->hasMany(PeminjamanAlatBahan::class, 'ID_RUANG_LABORATORIUM');
	}
}
