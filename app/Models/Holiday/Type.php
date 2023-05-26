<?php

namespace App\Models\Holiday;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Holiday\Type
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday\Type whereName($value)
 * @mixin \Eloquent
 * @property string $url
 * @property string $explanation
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday\Type whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Holiday\Type whereUrl($value)
 */
class Type extends Model
{

    public $table = 'holiday_types';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'explanation'
    ];
}
