<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * 
 * @property int $id
 * @property string $user_id
 * @property string $service_id
 * @property float $rating
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Service $service
 * @property User $user
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'review';

	protected $casts = [
		'rating' => 'float'
	];

	protected $fillable = [
		'user_id',
		'service_id',
		'rating',
		'comment'
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
