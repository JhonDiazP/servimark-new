<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemRolePermission
 * 
 * @property int $id
 * @property int $item_id
 * @property int $role_id
 * @property int $permission_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Item $item
 * @property Permission $permission
 * @property Role $role
 *
 * @package App\Models
 */
class ItemRolePermission extends Model
{
	protected $table = 'item_role_permission';

	protected $casts = [
		'item_id' => 'int',
		'role_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'item_id',
		'role_id',
		'permission_id'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}
}
