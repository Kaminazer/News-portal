<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TagsNews extends Model
{

    protected $guarded = [];
    protected $table = "tags_news";

    public function new():BelongsTo
    {
        return $this->belongsTo(News::class,"news_id","id");
    }
}
