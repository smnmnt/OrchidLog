<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AquaTestResults extends Model
{
	public const string STATUS_NORMAL = 'normal';
	public const string STATUS_DEVIATION = 'deviation';
	public const string STATUS_CATASTROPHE = 'catastrophe';
	public const string STATUS_UNKNOWN = 'unknown';

	protected $fillable = [
		'test_id',
		'type_id',
		'value',
	];

	protected $casts = [
		'value' => 'decimal:2',
	];

	public function test(): BelongsTo
	{
		return $this->belongsTo(AquaTests::class, 'test_id');
	}

	public function type(): BelongsTo
	{
		return $this->belongsTo(AquaTestTypes::class, 'type_id');
	}

	public function status(): string
	{
		$type = $this->type;

		if (! $type || $type->value_min === null || $type->value_max === null) {
			return self::STATUS_UNKNOWN;
		}

		$value = (float) $this->value;
		$min = (float) $type->value_min;
		$max = (float) $type->value_max;

		if ($value >= $min && $value <= $max) {
			return self::STATUS_NORMAL;
		}

		$distance = $value < $min ? $min - $value : $value - $max;
		$normalRange = max($max - $min, 1);

		return $distance >= ($normalRange * 0.5)
			? self::STATUS_CATASTROPHE
			: self::STATUS_DEVIATION;
	}

	public function statusLabel(): string
	{
		return match ($this->status()) {
			self::STATUS_NORMAL => 'Норма',
			self::STATUS_DEVIATION => 'Отклонение',
			self::STATUS_CATASTROPHE => 'Катастрофа',
			default => 'Неизвестно',
		};
	}

	public function statusBadgeClass(): string
	{
		return match ($this->status()) {
			self::STATUS_NORMAL => 'bg-success',
			self::STATUS_DEVIATION => 'bg-warning text-dark',
			self::STATUS_CATASTROPHE => 'bg-danger',
			default => 'bg-secondary',
		};
	}
}
