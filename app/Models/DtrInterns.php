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
    // app/Models/DtrInterns.php

    public function getTotalHoursDisplayAttribute()
    {
        $am = 0;
        $pm = 0;

        if ($this->time_in_am && $this->time_out_am) {
            $am = \Carbon\Carbon::parse($this->time_out_am)->diffInMinutes(\Carbon\Carbon::parse($this->time_in_am));
        }

        if ($this->time_in_pm && $this->time_out_pm) {
            $pm = \Carbon\Carbon::parse($this->time_out_pm)->diffInMinutes(\Carbon\Carbon::parse($this->time_in_pm));
        }

        $totalMinutes = $am + $pm;
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}