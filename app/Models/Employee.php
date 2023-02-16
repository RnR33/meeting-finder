<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'emp';
    protected $fillable = ['emp_id','name'];

    public function meeting(): HasMany
    {
        return $this->hasMany(Meeting::class, 'emp_id', 'emp_id');
    }
}
