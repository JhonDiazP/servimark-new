<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryOrderStatus
 * 
 * @property int $id
 * @property string $order_id
 * @property int $order_status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property OrderStatus $order_status
 *
 * @package App\Models
 */
class HistoryOrderStatus extends Model
{
	protected $table = 'history_order_status';

	protected $casts = [
		'order_status_id' => 'int'
	];

	protected $fillable = [
		'order_id',
		'order_status_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function order_status()
	{
		return $this->belongsTo(OrderStatus::class);
	}
}
