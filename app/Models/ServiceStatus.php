<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceStatus
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HistoryServiceStatus[] $history_service_statuses
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class ServiceStatus extends Model
{
	protected $table = 'service_status';

	protected $fillable = [
		'name'
	];

	public function history_service_statuses()
	{
		return $this->hasMany(HistoryServiceStatus::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}
}
