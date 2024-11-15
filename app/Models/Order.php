<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property string $id
 * @property int $order_status_id
 * @property string $user_id
 * @property int $total_amount
 * @property Carbon $order_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property OrderStatus $order_status
 * @property User $user
 * @property Collection|HistoryOrderStatus[] $history_order_statuses
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	public $incrementing = false;

	protected $casts = [
		'order_status_id' => 'int',
		'total_amount' => 'int',
		'order_date' => 'datetime'
	];

	protected $fillable = [
		'order_status_id',
		'user_id',
		'total_amount',
		'order_date'
	];

	public function order_status()
	{
		return $this->belongsTo(OrderStatus::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function history_order_statuses()
	{
		return $this->hasMany(HistoryOrderStatus::class);
	}

	public function services()
	{
		return $this->belongsToMany(Service::class, 'order_services')
					->withPivot('id', 'quantity')
					->withTimestamps();
	}

	public function orderServices()
	{
		return $this->hasMany(OrderService::class);
	}
}
