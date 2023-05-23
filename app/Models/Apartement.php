<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\Elasticquent;
use Laravel\Scout\Searchable;

class Apartement extends Model
{
    use HasFactory;
    use Searchable;
    protected $table = 'appartements';
    protected $guarded = [];
    protected $fillabele = [
        'id',
        'title',
        'photo',
        'desc',
        'extra',
        'price',
        'perks',
        'type',
        'wilaya',
        'commune',
        'maxguests',
    ];
    
}
