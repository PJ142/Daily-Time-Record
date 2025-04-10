<?php

namespace App\Models;

use App\Models\AssignedInterns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DtrInterns extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_intern_id',
        'time_in_am',
        'time_out_am',
        'time_in_pm',
        'time_out_pm',
        'date',
    ];

    public function assignedIntern()
    {
        return $this->belongsTo(AssignedInterns::class, 'assigned_intern_id');
    }
}