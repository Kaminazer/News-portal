<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\UpdateRequest;
use App\Models\News;
use App\Service\TagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(News $new, UpdateRequest $request, TagService $service):RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedTags = explode(',', $validatedData['tags']);
        unset($validatedData['tags']);
        if (!empty($validatedData['image']))
        {
            $validatedData['image'] = Storage::disk('public')->put('/images', $validatedData['image']);
        }
        $previousTags = $new->tags->pluck('title')->toArray();
        $existingTags = $service->ifExist(array_diff($validatedTags, $previousTags));
        if(empty($existingTags)) {
            $deletedTags = array_diff($previousTags, $validatedTags);
            $newTags = array_diff($validatedTags, $previousTags);
            if (!empty($deletedTags)){
                $service->deleteLinks($deletedTags);
                $service->deleteTags($deletedTags);
            }
            if(!empty($newTags)){
                $service->createTag($newTags, $new);
                $service->addLinks($newTags);
            }
            $validatedData['content'] = $service->checkContent($validatedData['content'], $deletedTags);


            $new->update($validatedData);
            return redirect()->route('new.show', $new->id);
        }
        return back()->withErrors(['tags'=>"Не використовуйте ці теги, вони пов'язані з іншою новиною: ".implode(", ", $existingTags)]);
    }
}
