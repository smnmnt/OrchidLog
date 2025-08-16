<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFlower_Images
 */
class Flower_Images extends Model
{
    public $table = 'flower_images';
    protected $primaryKey = 'ID';
}
