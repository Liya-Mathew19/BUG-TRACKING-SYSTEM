<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;
    protected $fillable = [
        'tracker',
        'issue_description',
        'status',
    ];

    public function projects()
    {
        return $this->belongsTo('App\Projects');
    }
}
