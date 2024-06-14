<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;


class IndexController extends Controller
{
    public function __invoke():View
    {
        return view('admin.new.index', [
            'news' => News::select('id', 'title', 'status_display')->orderBy('updated_at','DESC')->get(),
        ]);
    }
}
