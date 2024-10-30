<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Website;
use App\Events\PostCreated; 

class PostService
{
    /**
     *
     * @param int $websiteId
     * @param array $data
     * @return Post
     */
    public function createPost($websiteId, $data)
    {
        $website = Website::findOrFail($websiteId);

        $post = Post::create([
            'website_id' => $website->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        event(new PostCreated($post));

        return $post;
    }
}
