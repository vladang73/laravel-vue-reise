<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Provider
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereName($value)
 * @mixin \Eloquent
 */
class Provider extends Model
{

    const PREISDALER = 1;
    const REISBUREAU = 2;

    public $table = 'providers';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
}
