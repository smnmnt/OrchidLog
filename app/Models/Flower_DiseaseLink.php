<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFlower_DiseaseLink
 */
class Flower_DiseaseLink extends Model
{
    public $table = 'flower_disease_links';
    protected $primaryKey = 'ID';
}
