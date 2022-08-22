<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Abstract class CoreModel
 *
 * Super eloquent model class
 *
 * @package namespace App\Core\Entities;
 */
abstract class CoreModel extends Model implements Transformable
{
    use HasFactory;
    use TransformableTrait;
}