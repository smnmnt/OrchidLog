<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWatering_Groups
 */
class Watering_Groups extends Model
{
    public $table = 'watering_groups';
    protected $primaryKey = 'ID';
}
