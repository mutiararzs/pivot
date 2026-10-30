<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['category', 'text', 'sort_order'];

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'R' => 'REALISTIC (R)',
            'I' => 'INVESTIGATIVE (I)',
            'A' => 'ARTISTIC (A)',
            'S' => 'SOCIAL (S)',
            'E' => 'ENTERPRISING (E)',
            default => 'CONVENTIONAL (C)',
        };
    }
}