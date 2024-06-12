<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{

    protected $table = "new";
    protected $guarded = [];

    public function tags():HasMany
    {
        return $this->hasMany(TagsNews::class);
    }
}
