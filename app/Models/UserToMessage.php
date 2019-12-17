<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToMessage extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'user_to_message';

    // public function client()
    // {
    //     return $this->hasOne(Client::class, 'client_id')->first();
    // }

    // public function messenger()
    // {
    //     return $this->belongsTo(Messenger::class, 'messenger_id')->get();
    // }
}
