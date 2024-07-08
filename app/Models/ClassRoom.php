<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;


class ClassRoom extends Model
{
    use HasFactory, HasEagerLimit;

    protected $table = "class";

    public function siswa()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    public function wali()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
}
