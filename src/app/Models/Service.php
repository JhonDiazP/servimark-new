<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property string $id
 * @property int $service_status_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $category_id
 * @property int $municipality_id
 * @property string|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Municipality $municipality
 * @property ServiceStatus $service_status
 * @property User|null $user
 * @property Collection|HistoryServiceStatus[] $history_service_statuses
 * @property Collection|ImageService[] $image_services
 * @property Collection|Order[] $orders
 * @property Collection|Review[] $reviews
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';
	public $incrementing = false;

	protected $casts = [
		'service_status_id' => 'int',
		'price' => 'float',
		'category_id' => 'int',
		'municipality_id' => 'int'
	];

	protected $fillable = [
		'service_status_id',
		'name',
		'description',
		'price',
		'category_id',
		'municipality_id',
		'user_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function municipality()
	{
		return $this->belongsTo(Municipality::class);
	}

	public function service_status()
	{
		return $this->belongsTo(ServiceStatus::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function history_service_statuses()
	{
		return $this->hasMany(HistoryServiceStatus::class);
	}

	public function image_services()
	{
		return $this->hasMany(ImageService::class);
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class, 'order_services')
					->withPivot('id', 'quantity')
					->withTimestamps();
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'user_service')
					->withPivot('id')
					->withTimestamps();
	}
}
