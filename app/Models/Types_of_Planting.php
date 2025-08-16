<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTypes_of_Planting
 */
class Types_of_Planting extends Model
{
    public $table = 'types_of_planting';
    protected $primaryKey = 'ID';
}
