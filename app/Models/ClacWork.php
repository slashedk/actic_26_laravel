<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['poste', 'date_limite', 'piece_a_fournir', 'photo', 'user_id'])]
class ClacWork extends Model
{
    //
}
