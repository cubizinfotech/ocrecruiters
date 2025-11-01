<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    // optional: if you named table differently
    // protected $table = 'states';

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * A state has many cities.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
