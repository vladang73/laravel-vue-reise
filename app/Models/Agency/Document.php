<?php

namespace App\Models\Agency;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Agency\Document
 *
 * @property int $id
 * @property int|null $agency_id
 * @property string|null $name
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency\Document whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency\Document whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency\Document whereUrl($value)
 * @mixin \Eloquent
 */
class Document extends Model
{

    public $table = 'agencies_documents';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'agency_id', 'url'
    ];
}
