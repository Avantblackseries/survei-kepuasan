<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $fillable = ['survey_id', 'question_text', 'question_type', 'options', 'order'];

    public function survey() {
        return $this->belongsTo(Survey::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function getOptionsArrayAttribute() {
        return $this->options ? explode(',', $this->options) : [];
    }
}