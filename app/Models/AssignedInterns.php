<?php

namespace App\Models;

use App\Models\DtrInterns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignedInterns extends Model
{
    use HasFactory;

    protected $fillable = [
        'intern_id',
        'supervisor_id',
        'internship_start_date',
        'internship_end_date',
        'total_hours'
    ];

    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function dtrInterns()
    {
        return $this->hasMany(DtrInterns::class, 'assigned_intern_id');
    }
}