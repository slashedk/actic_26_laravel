<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(
    [
        'titre',
        'date_limite',
        'age_min',
        'age_max',
        'pieces_a_fournir',
        'image_url',
        'lieu_depot',
        'societe',
        'contact',
        'user_id',
    ]
)]
class ClacWork extends Model
{
    //
}
