<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
     /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'f_a_q_s';
}
