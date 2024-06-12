<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Service\TagService;
use Illuminate\Http\RedirectResponse;

class DestroyController extends Controller
{
    public function __invoke(News $new, TagService $service): RedirectResponse
    {
        $tags = $new->tags->pluck('title')->toArray();
        $service->deleteLinks($tags);
        $new->delete();
        return redirect()->route('new.index');
    }
}
