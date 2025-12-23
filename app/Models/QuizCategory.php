<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    use HasFactory;

    protected $table = 'quiz_categories';

    protected $fillable = [
        'quiz_id',
        'category_id',
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
