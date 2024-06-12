<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\StoreRequest;
use App\Models\News;
use App\Models\TagsNews;
use App\Service\TagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, TagService $service):RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedTags = $validatedData['tags'];
        unset($validatedData['tags']);
        $validatedData['image'] = Storage::disk('public')->put('/images', $validatedData['image']);
        $convertedTags = explode(',',$validatedTags);
        $allTags = TagsNews::pluck('title')->toArray();
        foreach ($convertedTags as $tag)
        {
            if (in_array($tag, $allTags))
            {
                $existingTags[] = $tag;
            }
        }
        if (empty($existingTags)){
            $modifiedContent = $service->checkContent($validatedData['content']);
            $validatedData['content'] = $modifiedContent;
            $new = News::create($validatedData);
            $service->createTag($convertedTags, $new);
            $service->addLinks($convertedTags);
            return redirect()->route('new.index');
        }
        return back()->withErrors(['tags'=>"Не використовуйте ці теги, вони пов'язані з іншою новиною ".implode(", ", $existingTags)]);
    }
}
