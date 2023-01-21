<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionList extends Model
{
    use HasFactory;
    protected $table = 'question_list';
    protected $primaryKey = 'id';
    protected $fillable = ['questionnaire_id', 'question_id'];
}
