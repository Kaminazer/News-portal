<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke()
    {
        $news = News::select('id', 'title', 'image', 'created_at')->where('status_display', 1)->orderBy('created_at', 'DESC')->paginate(6);
        foreach ($news as $itemNews)
        {
            $itemNews->created_at = Carbon::parse($itemNews->created_at);
        }
        return view('new.index', compact('news'));
    }
}
