<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string|null $class
 * @property string|null $icon
 * @property string $action
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Item[] $items
 * @property Collection|Role[] $roles
 *
 * @package App\Models
 */
class Permission extends Model
{
	protected $table = 'permission';

	protected $fillable = [
		'name',
		'class',
		'icon',
		'action'
	];

	public function items()
	{
		return $this->belongsToMany(Item::class, 'item_role_permission')
					->withPivot('id', 'role_id')
					->withTimestamps();
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'item_role_permission')
					->withPivot('id', 'item_id')
					->withTimestamps();
	}
}
