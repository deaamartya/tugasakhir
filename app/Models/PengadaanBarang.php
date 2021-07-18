<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PengadaanBarang
 * 
 * @property string $ID_PENGADAAN
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class PengadaanBarang extends Model
{
	protected $table = 'pengadaan_barang';
	protected $primaryKey = 'ID_PENGADAAN';
	public $incrementing = false;
	public $timestamps = false;
}
