<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * @property int|null $item_parent_id
 * @property string|null $code
 * @property string $name
 * @property string|null $route
 * @property string|null $icon
 * @property bool $show_menu
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Item|null $item
 * @property Collection|Permission[] $permissions
 * @property Collection|Role[] $roles
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';

	protected $casts = [
		'item_parent_id' => 'int',
		'show_menu' => 'bool'
	];

	protected $fillable = [
		'item_parent_id',
		'code',
		'name',
		'route',
		'icon',
		'show_menu'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_parent_id');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'item_role_permission')
					->withPivot('id', 'role_id')
					->withTimestamps();
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'item_role_permission')
					->withPivot('id', 'permission_id')
					->withTimestamps();
	}

	public function items()
	{
		return $this->hasMany(Item::class, 'item_parent_id');
	}
}
