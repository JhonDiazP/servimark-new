<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipality
 * 
 * @property int $id
 * @property int $departament_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Departament $departament
 * @property Collection|Service[] $services
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Municipality extends Model
{
	protected $table = 'municipalities';

	protected $casts = [
		'departament_id' => 'int'
	];

	protected $fillable = [
		'departament_id',
		'name'
	];

	public function departament()
	{
		return $this->belongsTo(Departament::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
