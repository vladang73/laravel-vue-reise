<?php

namespace App\Models;


use App\Models\Agency\Document;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Agency
 *
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $phone
 * @property string $site
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Agency whereSite($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Agency\Document[] $documents
 */
class Agency extends Model
{

    public $table = 'travel_agencies';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $value);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'agency_id', 'id');
    }
}
