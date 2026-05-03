<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AquaTests extends Model
{
	public const string SOURCE_TYPE_AQUARIUM = 'aquarium';
	public const string SOURCE_TYPE_TAP = 'tap';

	private const array STATUS_PRIORITY = [
		AquaTestResults::STATUS_UNKNOWN => 0,
		AquaTestResults::STATUS_NORMAL => 1,
		AquaTestResults::STATUS_DEVIATION => 2,
		AquaTestResults::STATUS_CATASTROPHE => 3,
	];

	protected $fillable = [
		'source_type',
		'source_name',
		'aquarium_id',
		'tested_at',
		'notes',
	];

	protected $casts = [
		'tested_at' => 'datetime',
	];

	public function aquarium(): BelongsTo
	{
		return $this->belongsTo(Aquariums::class, 'aquarium_id');
	}

	public function results(): HasMany
	{
		return $this->hasMany(AquaTestResults::class, 'test_id');
	}

	public function overallStatus(): string
	{
		$results = $this->relationLoaded('results')
			? $this->results
			: $this->results()->with('type')->get();

		if ($results->isEmpty()) {
			return AquaTestResults::STATUS_UNKNOWN;
		}

		return $results
			->map(fn (AquaTestResults $result) => $result->status())
			->sortByDesc(fn (string $status) => self::STATUS_PRIORITY[$status] ?? 0)
			->first();
	}

	public function overallStatusLabel(): string
	{
		return match ($this->overallStatus()) {
			AquaTestResults::STATUS_NORMAL => 'Норма',
			AquaTestResults::STATUS_DEVIATION => 'Отклонение',
			AquaTestResults::STATUS_CATASTROPHE => 'Катастрофа',
			default => 'Неизвестно',
		};
	}

	public function overallStatusBadgeClass(): string
	{
		return match ($this->overallStatus()) {
			AquaTestResults::STATUS_NORMAL => 'bg-success',
			AquaTestResults::STATUS_DEVIATION => 'bg-warning text-dark',
			AquaTestResults::STATUS_CATASTROPHE => 'bg-danger',
			default => 'bg-secondary',
		};
	}

	public function sourceLabel(): string
	{
		if ($this->source_type === self::SOURCE_TYPE_AQUARIUM) {
			return $this->aquarium?->name ?? '—';
		}

		return $this->source_name ?: 'Водопровод';
	}
}
