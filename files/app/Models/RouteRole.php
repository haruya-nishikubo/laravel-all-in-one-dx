<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RouteRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function routePolicies()
    {
        return $this->belongsToMany(RoutePolicy::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
