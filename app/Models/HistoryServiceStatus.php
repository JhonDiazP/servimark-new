<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryServiceStatus
 * 
 * @property int $id
 * @property string $service_id
 * @property int $service_status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 * @property ServiceStatus $service_status
 *
 * @package App\Models
 */
class HistoryServiceStatus extends Model
{
	protected $table = 'history_service_status';

	protected $casts = [
		'service_status_id' => 'int'
	];

	protected $fillable = [
		'service_id',
		'service_status_id'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function service_status()
	{
		return $this->belongsTo(ServiceStatus::class);
	}
}
