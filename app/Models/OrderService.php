<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderService
 * 
 * @property int $id
 * @property string $service_id
 * @property string $order_id
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property Service $service
 * @property Collection|HistoryOrderService[] $history_order_services
 *
 * @package App\Models
 */
class OrderService extends Model
{
	protected $table = 'order_services';

	protected $casts = [
		'quantity' => 'int'
	];

	protected $fillable = [
		'service_id',
		'order_id',
		'quantity'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function history_order_services()
	{
		return $this->hasMany(HistoryOrderService::class);
	}
}
