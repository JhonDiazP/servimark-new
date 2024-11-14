<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryUserStatus
 * 
 * @property int $id
 * @property string $user_id
 * @property int $user_status_id
 * @property string $description
 * @property string $user_id_updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property UserStatus $user_status
 *
 * @package App\Models
 */
class HistoryUserStatus extends Model
{
	protected $table = 'history_user_status';

	protected $casts = [
		'user_status_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'user_status_id',
		'description',
		'user_id_updated_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id_updated_by');
	}

	public function user_status()
	{
		return $this->belongsTo(UserStatus::class);
	}
}
