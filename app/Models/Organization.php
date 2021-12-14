<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Traits\Uuids;
use Illuminate\Notifications\Notifiable;



class Organization extends Model
{
    use Uuids, Notifiable;
    use HasFactory;
    use AsSource;

    protected $fillable = [
        'name',
        'organization_id',
    ];

}




