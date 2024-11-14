<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStatus
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|HistoryOrderStatus[] $history_order_statuses
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class OrderStatus extends Model
{
	protected $table = 'order_status';

	protected $fillable = [
		'name'
	];

	public function history_order_statuses()
	{
		return $this->hasMany(HistoryOrderStatus::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
