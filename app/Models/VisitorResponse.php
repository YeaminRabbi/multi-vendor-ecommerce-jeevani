<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorResponse extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'answer_id' , 'question_id'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
