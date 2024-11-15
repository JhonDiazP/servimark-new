<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * 
 * @property int $id
 * @property string $user_id
 * @property string $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 * @property User $user
 *
 * @package App\Models
 */
class UserService extends Model
{
	protected $table = 'user_service';

	protected $fillable = [
		'user_id',
		'service_id'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
