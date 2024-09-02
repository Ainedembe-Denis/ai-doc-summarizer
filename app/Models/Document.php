<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'docName',
        'filename',
        'gpt_prompt',
        'gpt_processed_data',
        'created_by',
    ];
}
