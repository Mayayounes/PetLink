<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'gender', 'age', 'medical_history', 'image', 'category', 'breed'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
