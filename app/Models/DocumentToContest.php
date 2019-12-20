<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentToContest extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    protected $table = 'document_to_contests';
}
