<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWatering_Types_Of
 */
class Watering_Types_Of extends Model
{
    public $table = 'watering_types_of';
    protected $primaryKey = 'ID';
}
