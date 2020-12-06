<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KatalogBahan
 * 
 * @property string $ID_KATALOG_BAHAN
 * @property int $ID_LABORATORIUM
 * @property string $NAMA_KATALOG_BAHAN
 * 
 * @property Laboratorium $laboratorium
 * @property Collection|BahanKimium[] $bahan_kimia
 *
 * @package App\Models
 */
class KatalogBahan extends Model
{
	protected $table = 'katalog_bahan';
	protected $primaryKey = 'ID_KATALOG_BAHAN';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_LABORATORIUM' => 'int'
	];

	protected $fillable = [
		'ID_LABORATORIUM',
		'NAMA_KATALOG_BAHAN'
	];

	public function laboratorium()
	{
		return $this->belongsTo(Laboratorium::class, 'ID_LABORATORIUM');
	}

	public function bahan_kimia()
	{
		return $this->hasMany(BahanKimium::class, 'ID_KATALOG_BAHAN');
	}
}
