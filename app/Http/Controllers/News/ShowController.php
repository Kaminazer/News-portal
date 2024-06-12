<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;

class ShowController extends Controller
{
    public function __invoke(News $new)
    {
        $news = News::where('status_display', 1)->orderBy('created_at', 'DESC')->pluck('id');
        $currentIndex = $news->search($new->id);
        $nextNewId = $news->skip($currentIndex + 1 )->first();
        if (empty($nextNewId)){
            $nextNewId = $new->id;
        }
        $previousNewId = $news->take($currentIndex)->last();

        if (empty($previousNewId)){
            $previousNewId = $new->id;
        }
        return view('new.show', [
            'itemNews' => $new,
            'previousNewsId' => $previousNewId,
            'nextNewsId' => $nextNewId,
        ]);
    }
}
