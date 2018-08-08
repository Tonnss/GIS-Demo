<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Countries extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'id',
        'name',
        'country_code',
        'capital',
        'position'
    ];

    protected $spatialFields = [
        'coordinates'
    ];
}
