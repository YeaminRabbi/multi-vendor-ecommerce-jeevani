<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text','question_section_id'];

    public function section()
    {
        return $this->belongsTo(QuestionSection::class,  'question_section_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
