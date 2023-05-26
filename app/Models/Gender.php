<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gender
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Gender whereName($value)
 * @mixin \Eloquent
 */
class Gender extends Model
{

    const MAN = 1;
    const WOMAN = 2;

    public $table = 'genders';
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
