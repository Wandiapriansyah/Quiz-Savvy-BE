<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'score', 'taken_at'];

    // Relasi 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quizzes()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function recapJawaban()
    {
        return $this->hasMany(RecapJawaban::class, 'result_id');
    }
}
