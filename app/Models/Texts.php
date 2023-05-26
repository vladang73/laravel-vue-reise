<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Texts
 *
 * @property int $id
 * @property int $provider_id
 * @property string $first_title
 * @property string $first_paragraph
 * @property string $second_title
 * @property string $second_paragraph
 * @property string $third_title
 * @property string $third_paragraph
 * @property string $epilogue
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereEpilogue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereFirstParagraph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereFirstTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereSecondParagraph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereSecondTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereThirdParagraph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Texts whereThirdTitle($value)
 * @mixin \Eloquent
 */
class Texts extends Model
{

    public $table = 'privacy_texts';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_title', 'first_paragraph', 'second_title', 'second_paragraph', 'third_title', 'third_paragraph',
        'epilogue'
    ];
}
