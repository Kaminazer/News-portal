<?php

namespace App\Service;

use App\Models\News;
use App\Models\TagsNews;

class TagService
{
    public function addLinks(array $tags, $id){
        $allNews = News::WhereNotIn('id', [$id])->get()->flatten(1);
        foreach ($tags as $tag) {
            $instanceTag = TagsNews::where('title', $tag)->first();
            $foundedNews = $allNews->filter( function ($news) use ($tag) {
                return preg_match_all("/\b$tag\b/ui",$news->content,$matches);
            });
            if($foundedNews->isNotEmpty()) {
                foreach ($foundedNews as $itemNews) {
                    $urlForTag = route('new.show', ["new" => $instanceTag->new->id]);
                    $itemNews->content = preg_replace(
                        "/\b$tag\b/ui",
                        "<a href = '$urlForTag'> $0 </a>",
                        $itemNews->content
                    );
                    $itemNews->save();
                }
            }
        }
    }

    public function checkContent($content, array $deletedTags = null)
    {
        $tags = TagsNews::all();
        foreach ( $tags as $tag) {
            preg_match_all("/\b$tag->title\b/ui",$content,$matches );
            if(!empty($matches[0])){
                $idRelatedNews = $tag->new->id;
                $urlForTag = route('new.show', ["new" => $idRelatedNews]);
                $content = preg_replace(
                    "#\b$tag->title\b(?![^<]*</a>)#ui",
                    "<a href = '$urlForTag' > $0 </a>",
                    $content
                );
            }
        }
        if ($deletedTags != null) {
            foreach ($deletedTags as $tag) {
                $content = preg_replace("#<a [^<a]+\s*($tag)\s*</a>#ui", "$1", $content);
            }
        }
        return $content;
    }

    public function deleteLinks(array $deletedTags, $id)
    {
        $allNews = News::WhereNotIn('id', [$id])->get()->flatten(1);
        foreach ($deletedTags as $tag) {
            $foundedNews = $allNews->filter(function ($new) use ($tag) {
             return preg_match_all("/\b$tag\b/ui", $new->content, $matches);
            });
            if($foundedNews->isNotEmpty()){
                foreach ($foundedNews as $itemNews) {
                    $itemNews->content = preg_replace("#<a [^<a]+\s*($tag)\s*</a>#ui","$1", $itemNews->content);
                    $itemNews->save();
                }
            }
        }

    }

    public function deleteTags(array $deletedTags)
    {
        foreach ($deletedTags as $tag){
            TagsNews::where("title", $tag)->first()->delete();
        }
    }

    public function createTag(array $tags, News $new)
    {
        foreach ($tags as $tag) {
            TagsNews::create([
                'title'=> $tag,
                'news_id'=>$new->id,
            ]);
        }
    }

    public function ifExist($tags){
        $allTags = TagsNews::pluck('title')->toArray();
        $existingTags = [];
        foreach ($tags as $tag)
        {
            if (in_array($tag, $allTags))
            {
                $existingTags[] = $tag;
            }
        }
    return $existingTags;
    }
}
