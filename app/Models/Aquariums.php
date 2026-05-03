<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aquariums extends Model
{
	protected $fillable = [
		'id',
		'name',
		'volume',
		'description',
	];

	public function tests(): HasMany
	{
		return $this->hasMany(AquaTests::class, 'aquarium_id');
	}
}
