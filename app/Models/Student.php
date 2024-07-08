<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Student extends Model
{
    use HasFactory, HasEagerLimit;

    public function kelas()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id', 'id');
    }

    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'student_ekskul', 'student_id', 'ekskul_id');
    }
}
