<?php

namespace App\Services\Aqua\Calculators;

use App\Models\AquaTests;

interface AquaCalculatedTest
{
	public function calculate(AquaTests $test): ?float;
}
