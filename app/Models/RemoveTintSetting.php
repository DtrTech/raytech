<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoveTintSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'fws',
        'rws',
        'l1',
        'l2',
        'l3',
        'r1',
        'r2',
        'r3',
        'srf',
        'srf2',
    ];
}
