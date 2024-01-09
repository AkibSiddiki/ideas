<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'idea_id'];

    public function idea()
    {
        return $this->belongsTo(idea::class);
    }
}
