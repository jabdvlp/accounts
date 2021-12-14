<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\Uuids;
use Illuminate\Notifications\Notifiable;


class Outcome extends Model
{
    use HasFactory;

    protected $filliable = [
        'amount',
        'status',

    ];
}
