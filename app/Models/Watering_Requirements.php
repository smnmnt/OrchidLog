<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWatering_Requirements
 */
class Watering_Requirements extends Model
{
    public $table = 'watering_requirements';
    protected $primaryKey = 'ID';
}
