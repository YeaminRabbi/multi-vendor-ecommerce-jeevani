<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'answer_text', 'patient_type', 'attributes'];

    protected $casts = [
        'attributes' => 'array',  // Store answer-related attributes in an array
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
