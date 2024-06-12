<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;

class EditController extends Controller
{
    public function __invoke(News $new):View
    {
        return view('admin.new.edit', [
            'itemNews' => $new,
            'tags' => implode(',',$new->tags->pluck('title')->toArray()),
        ]);
    }
}
