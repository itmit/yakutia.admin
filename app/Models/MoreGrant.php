<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoreGrant extends Model
{
     /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'more_grants';
}
