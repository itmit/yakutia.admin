<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToEvent extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'user_to_events';

    public function user()
    {
        return $this->belongsTo(Client::class, 'user_id')->first();
    }
}
