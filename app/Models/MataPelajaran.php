<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MataPelajaran
 * 
 * @property string $ID_MAPEL
 * @property string $NAMA_MAPEL
 * 
 * @property Collection|Praktikum[] $praktikums
 *
 * @package App\Models
 */
class MataPelajaran extends Model
{
	protected $table = 'mata_pelajaran';
	protected $primaryKey = 'ID_MAPEL';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'NAMA_MAPEL'
	];

	public function praktikums()
	{
		return $this->hasMany(Praktikum::class, 'ID_MAPEL');
	}
}
