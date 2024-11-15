<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

/**
 * Class User
 * 
 * @property string $id
 * @property int $user_status_id
 * @property int $identification_type_id
 * @property int|null $gender_id
 * @property string $identification
 * @property string $first_name
 * @property string|null $middle_first_name
 * @property string $last_name
 * @property string|null $middle_last_name
 * @property string $username
 * @property string $phone
 * @property string|null $phone_home
 * @property int $municipality_id
 * @property string $email
 * @property string|null $address
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Gender|null $gender
 * @property IdentificationType $identification_type
 * @property Municipality $municipality
 * @property UserStatus $user_status
 * @property Collection|HistoryUserStatus[] $history_user_statuses
 * @property Collection|Order[] $orders
 * @property Collection|Review[] $reviews
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'id' => 'string',
		'user_status_id' => 'int',
		'identification_type_id' => 'int',
		'gender_id' => 'int',
		'municipality_id' => 'int',
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'id',
		'identification_type_id',
		'gender_id',
		'identification',
		'first_name',
		'middle_first_name',
		'last_name',
		'middle_last_name',
		'username',
		'phone',
		'phone_home',
		'municipality_id',
		'email',
		'address',
		'email_verified_at',
		'password'
	];

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function identification_type()
	{
		return $this->belongsTo(IdentificationType::class);
	}

	public function municipality()
	{
		return $this->belongsTo(Municipality::class);
	}

	public function user_status()
	{
		return $this->belongsTo(UserStatus::class);
	}

	public function history_user_statuses()
	{
		return $this->hasMany(HistoryUserStatus::class, 'user_id_updated_by');
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_role')
					->withPivot('id')
					->withTimestamps();
	}

	public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
