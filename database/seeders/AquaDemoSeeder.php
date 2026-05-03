<?php

namespace Database\Seeders;

use App\Models\AquaTestResults;
use App\Models\AquaTests;
use App\Models\AquaTestTypes;
use App\Models\Aquariums;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AquaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $types = collect([
            [
                'code' => 'ph',
                'name' => 'pH',
                'unit' => null,
                'kind' => AquaTestTypes::KIND_MEASURED,
                'calculator' => null,
                'is_user_editable' => true,
                'value_min' => 6.5,
                'value_max' => 7.5,
                'description' => 'Кислотность воды',
            ],
            [
                'code' => 'gh',
                'name' => 'GH',
                'unit' => 'dGH',
                'kind' => AquaTestTypes::KIND_MEASURED,
                'calculator' => null,
                'is_user_editable' => true,
                'value_min' => 4,
                'value_max' => 12,
                'description' => 'Общая жесткость',
            ],
            [
                'code' => 'kh',
                'name' => 'KH',
                'unit' => 'dKH',
                'kind' => AquaTestTypes::KIND_MEASURED,
                'calculator' => null,
                'is_user_editable' => true,
                'value_min' => 3,
                'value_max' => 8,
                'description' => 'Карбонатная жесткость',
            ],
            [
                'code' => 'no3',
                'name' => 'NO3',
                'unit' => 'mg/l',
                'kind' => AquaTestTypes::KIND_MEASURED,
                'calculator' => null,
                'is_user_editable' => true,
                'value_min' => 0,
                'value_max' => 25,
                'description' => 'Нитраты',
            ],
        ])->mapWithKeys(function (array $type) {
            $model = AquaTestTypes::query()->updateOrCreate(
                ['code' => $type['code']],
                $type,
            );

            return [$type['code'] => $model];
        });

        $mainAquarium = Aquariums::query()->updateOrCreate(
            ['name' => 'Основной аквариум'],
            [
                'volume' => 60,
                'description' => 'Демо-аквариум для проверки тестов воды',
            ],
        );

        $nanoAquarium = Aquariums::query()->updateOrCreate(
            ['name' => 'Нано аквариум'],
            [
                'volume' => 25,
                'description' => 'Второй демо-аквариум',
            ],
        );

        $tests = [
            [
                'key' => [
                    'source_type' => AquaTests::SOURCE_TYPE_AQUARIUM,
                    'source_name' => null,
                    'aquarium_id' => $mainAquarium->id,
                    'tested_at' => Carbon::create(2026, 5, 1, 19, 30),
                ],
                'notes' => 'Плановый тест основного аквариума',
                'results' => [
                    'ph' => 7.1,
                    'gh' => 8,
                    'kh' => 5,
                    'no3' => 12,
                ],
            ],
            [
                'key' => [
                    'source_type' => AquaTests::SOURCE_TYPE_AQUARIUM,
                    'source_name' => null,
                    'aquarium_id' => $nanoAquarium->id,
                    'tested_at' => Carbon::create(2026, 5, 2, 20, 15),
                ],
                'notes' => 'Проверка воды после подмены',
                'results' => [
                    'ph' => 6.8,
                    'gh' => 6,
                    'kh' => 4,
                    'no3' => 8,
                ],
            ],
            [
                'key' => [
                    'source_type' => AquaTests::SOURCE_TYPE_TAP,
                    'source_name' => 'Водопровод',
                    'aquarium_id' => null,
                    'tested_at' => Carbon::create(2026, 5, 3, 18, 45),
                ],
                'notes' => 'Тест водопроводной воды',
                'results' => [
                    'ph' => 7.4,
                    'gh' => 10,
                    'kh' => 7,
                    'no3' => 5,
                ],
            ],
        ];

        foreach ($tests as $testData) {
            $test = AquaTests::query()->updateOrCreate(
                $testData['key'],
                ['notes' => $testData['notes']],
            );

            foreach ($testData['results'] as $code => $value) {
                AquaTestResults::query()->updateOrCreate(
                    [
                        'test_id' => $test->id,
                        'type_id' => $types[$code]->id,
                    ],
                    ['value' => $value],
                );
            }
        }
    }
}
