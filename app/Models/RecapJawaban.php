<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapJawaban extends Model
{
    use HasFactory;

    protected $table = 'recap_jawaban';
    protected $fillable = ['result_id', 'question_id', 'jawaban_id'];

    // Relasi ke Result
    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    // Relasi ke Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi ke Jawaban
    public function jawaban()
    {
        return $this->belongsTo(Answer::class);
    }
}
