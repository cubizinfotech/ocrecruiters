<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','first_name', 'last_name', 'email', 'phone', 'address',
        'linkedin', 'github', 'portfolio', 'summary',
        'education', 'experience', 'skills', 'projects',
        'languages', 'certifications', 'hobbies', 'file_path', 'original_file_name',
        'logo_path', 'logo_original_name', 'banner_path', 'banner_original_name'
    ];

    // Cast JSON fields
    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'skills' => 'array',
        'projects' => 'array',
        'languages' => 'array',
        'certifications' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
