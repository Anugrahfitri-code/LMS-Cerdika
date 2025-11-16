<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id', 
        'title',
        'description',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}