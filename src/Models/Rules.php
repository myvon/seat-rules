<?php


namespace Lvlo\Rules\Models;


use Illuminate\Database\Eloquent\Model;
use Seat\Eveapi\Models\Alliances\Alliance;
use Seat\Eveapi\Models\Corporation\CorporationInfo;

class Rules extends Model
{

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'object_id', 'object_type', 'language',
    ];

    protected $primaryKey = "id";

    protected $guarded = ['id'];

    public function getObject()
    {
        if($this->object_type === "alliance") {
            return $this->hasOne(Alliance::class, 'alliance_id', 'object_id')->first();
        } else {
            return $this->hasOne(CorporationInfo::class, "corporation_id", "object_id")->first();
        }
    }
}