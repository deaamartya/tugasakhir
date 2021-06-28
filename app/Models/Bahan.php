<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bahan
 * 
 * @property string $ID_BAHAN
 * @property int $ID_LEMARI
 * @property string $NAMA_BAHAN
 * 
 * @property Lemari $lemari
 *
 * @package App\Models
 */
class Bahan extends Model
{
	protected $table = 'bahan';
	protected $primaryKey = 'ID_BAHAN';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ID_LEMARI' => 'int',
	];

	protected $fillable = [
		'ID_LEMARI',
		'NAMA_BAHAN',
		'ID_BAHAN',
	];

	public function lemari()
	{
		return $this->belongsTo(Lemari::class, 'ID_LEMARI');
	}
}
