<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $news = News::select('id', 'title', 'image', 'created_at')->where('status_display', 1)->orderBy('updated_at', 'DESC')->paginate(6);
        foreach ($news as $itemNews)
        {
            $itemNews->updated_at = Carbon::parse($itemNews->updated_at);
        }
        return view('new.index', compact('news'));
    }
}
