<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $table = 'reservations';
    protected $fillabele = [
        'id',
        'id_apartement',
        'checkin',
        'checkout'
    ];
    use HasFactory;
}
