<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Jenssegers\Mongodb\Eloquent\Model;

class HwpCampaign extends Model
{
    use HasFactory, DatabaseMigrations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign',
        'language',
        'check'
    ];
}
