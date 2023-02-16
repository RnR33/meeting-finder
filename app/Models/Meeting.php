<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    use HasFactory;

    protected $table = 'emp_meetings';
    protected $fillable = ['emp_id','start_dateTime','end_dateTime','details'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'emp_id','emp_id');
    }
}
