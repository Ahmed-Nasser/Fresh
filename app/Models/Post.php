<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string'
    ];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }
}
