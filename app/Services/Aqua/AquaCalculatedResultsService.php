<?php

namespace App\Services\Aqua;

use App\Models\AquaTestResults;
use App\Models\AquaTests;
use App\Models\AquaTestTypes;
use App\Services\Aqua\Calculators\AquaCalculatedTest;

class AquaCalculatedResultsService
{
	/**
	 * @var array<string, class-string<AquaCalculatedTest>>
	 */
	private array $calculators = [
		// 'co2_from_ph_kh' => \App\Services\Aqua\Calculators\Co2FromPhKhCalculator::class,
	];

	public function sync(AquaTests $test): void
	{
		$test->loadMissing('results.type');

		$calculatedTypes = AquaTestTypes::query()
			->where('kind', AquaTestTypes::KIND_CALCULATED)
			->whereNotNull('calculator')
			->get();

		foreach ($calculatedTypes as $type) {
			$calculator = $this->calculator($type->calculator);

			if (! $calculator) {
				continue;
			}

			$value = $calculator->calculate($test);

			if ($value === null) {
				AquaTestResults::query()
					->where('test_id', $test->id)
					->where('type_id', $type->id)
					->delete();

				continue;
			}

			AquaTestResults::query()->updateOrCreate(
				[
					'test_id' => $test->id,
					'type_id' => $type->id,
				],
				['value' => $value],
			);
		}
	}

	private function calculator(?string $key): ?AquaCalculatedTest
	{
		if (! $key || ! isset($this->calculators[$key])) {
			return null;
		}

		return app($this->calculators[$key]);
	}
}
