<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    /**
    * @var array
    */
   protected $guarded = ['id'];

   /**
    * @var string
    */
   protected $table = 'contests';
}
