<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    protected $fillable = [
        'title',
        'description',
        'gambar',
        'createdBy',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'createdBy');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
