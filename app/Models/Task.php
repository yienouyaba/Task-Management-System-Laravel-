<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'project_id', 'due_date'];

    protected $attributes = [
        'due_date' => null, 
    ];
    public function project()
{
    return $this->belongsTo(Project::class);
}
}
