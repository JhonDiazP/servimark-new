<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageService
 * 
 * @property int $id
 * @property string $service_id
 * @property string $path
 * @property bool $is_main
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 *
 * @package App\Models
 */
class ImageService extends Model
{
	protected $table = 'image_services';

	protected $casts = [
		'is_main' => 'bool'
	];

	protected $fillable = [
		'service_id',
		'path',
		'is_main'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
