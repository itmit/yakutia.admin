<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoreGrantToFile extends Model
{
     /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'more_grant_to_files';
}
