<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        Model::unguard();
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
