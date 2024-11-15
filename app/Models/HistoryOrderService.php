<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryOrderService
 * 
 * @property int $id
 * @property int $order_service_id
 * @property int $total_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property OrderService $order_service
 *
 * @package App\Models
 */
class HistoryOrderService extends Model
{
	protected $table = 'history_order_services';

	protected $casts = [
		'order_service_id' => 'int',
		'total_amount' => 'int'
	];

	protected $fillable = [
		'order_service_id',
		'total_amount'
	];

	public function order_service()
	{
		return $this->belongsTo(OrderService::class);
	}
}
