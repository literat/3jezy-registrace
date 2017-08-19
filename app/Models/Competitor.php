<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competitor extends Model
{

    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'birthday',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birthday',
        'deleted_at'
    ];

}
