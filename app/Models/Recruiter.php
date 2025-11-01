<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    use HasFactory;
    
    protected $appends = ['state_name', 'city_name'];
    
    protected $fillable = [
        'user_id', 'name', 'category_id', 'location_id', 'state_id', 'city_id', 'logo', 'rating', 'jobs_open'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resume()
    {
        return $this->hasOne(Resume::class, 'user_id', 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getStateNameAttribute()
    {
        return $this->state ? $this->state->name : null;
    }

    public function getCityNameAttribute()
    {
        return $this->city ? $this->city->name : null;
    }

}
