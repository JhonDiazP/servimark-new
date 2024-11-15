<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserStatus
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HistoryUserStatus[] $history_user_statuses
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class UserStatus extends Model
{
	protected $table = 'user_status';

	protected $fillable = [
		'name'
	];

	public function history_user_statuses()
	{
		return $this->hasMany(HistoryUserStatus::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
