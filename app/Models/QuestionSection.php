<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSection extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'question_section_id', 'id');
    }
}
