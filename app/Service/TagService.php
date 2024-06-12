<?php

namespace App\Service;

use App\Models\News;
use App\Models\TagsNews;

class TagService
{
    public function addLinks(array $tags){
        $allNews = News::all('id', 'content')->flatten(1);
        foreach ($tags as $tag) {
            $instanceTag = TagsNews::where('title', $tag)->first();
            $foundedNews = $allNews->filter( function ($news) use ($tag) {
                return preg_match_all("/\b$tag\b/ui",$news->content,$matches);
            });
            if(!empty($foundedNews)) {
                foreach ($foundedNews as $itemNews) {
                    $urlForTag = route('new.show', ["new" => $instanceTag->new->id]);
                    $itemNews->content = preg_replace(
                        "/\b$tag\b/ui",
                        "<a href = '$urlForTag' >$0</a>",
                        $itemNews->content
                    );
                    $itemNews->save();
                }
            }
        }
    }

    public function checkContent($content)
    {
        $tags = TagsNews::all();
        foreach ( $tags as $tag) {
            preg_match_all("/\b$tag->title\b/ui",$content,$matches );
            if(!empty($matches[0])){
                $idRelatedNews = $tag->new->id;
                $urlForTag = route('new.show', ["new" => $idRelatedNews]);
                $content = preg_replace(
                    "/\b$tag->title\b/ui",
                    "<a href = '$urlForTag' >$0</a>",
                    $content
                );
            }
        }
        return $content;
    }

    public function deleteLinks(array $deletedTags)
    {
        $allNews = News::all('id', 'content')->flatten(1);
        foreach ($deletedTags as $tag) {
            $foundedNews = $allNews->filter(function ($new) use ($tag) {
             return preg_match_all("/\b$tag\b/ui", $new->content, $matches);
            });
            if(!empty($foundedNews)){
                foreach ($foundedNews as $itemNews) {
                    $itemNews->content = preg_replace("#<a href = '.+\b$tag</a>#ui",$tag, $itemNews->content);
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
}
