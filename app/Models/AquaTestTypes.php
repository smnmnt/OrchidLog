<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AquaTestTypes extends Model
{
	public const string KIND_MEASURED = 'measured';
	public const string KIND_CALCULATED = 'calculated';

	protected $fillable = [
		'code',
		'name',
		'unit',
		'kind',
		'calculator',
		'is_user_editable',
		'value_min',
		'value_max',
		'description',
	];

	protected $casts = [
		'is_user_editable' => 'boolean',
		'value_min' => 'decimal:2',
		'value_max' => 'decimal:2',
	];

	public function results(): HasMany
	{
		return $this->hasMany(AquaTestResults::class, 'type_id');
	}

	public function isCalculated(): bool
	{
		return $this->kind === self::KIND_CALCULATED;
	}

	public function isMeasured(): bool
	{
		return $this->kind === self::KIND_MEASURED;
	}
}
