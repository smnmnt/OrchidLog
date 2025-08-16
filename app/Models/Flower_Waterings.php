<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFlower_Waterings
 */
class Flower_Waterings extends Model
{
    public $table = 'flower_waterings';
    protected $primaryKey = 'ID';
}
