<?php

namespace Toolkit\models;

class Post extends PostType
{
    const TYPE = 'post';


    public function categories(callable $callback = null)
    {
        return $this->terms(Category::class, $callback);
    }


    public function tags(callable $callback = null)
    {
        return $this->terms(Tag::class, $callback);
    }


    public function categories_name()
    {
        return implode(", ", $this->categories(function ($category) {
            return $category->title();
        }));
    }


    public function tags_name()
    {
        return implode(", ", $this->tags(function ($tag) {
            return $tag->title();
        }));
    }
}
