<?php

namespace App\View\Components\Posts\Single;

use Illuminate\View\Component;

use Modules\Post\Entities\Post;

class InfinitePostLoad extends Component
{
    public $post; // The current post.
    public $tag_pills; // Tags for current post.

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $post = Post::where(
            [
                'id'        => $id,
                'status'    => 'published'
            ]
        )->first();

        if ($post) {
            $post['description'] = Post::parseContent($post['description']);
            $post['seo_title'] = $post['title'] . ' | [sitetitle]';
            $post['url'] = 'post/' . $post['slug'];

            $tag_pills = $post->getTagNames();

            $this->post = $post;
            $this->tag_pills = $tag_pills;
        } else {
            $this->post = null;
            $this->tag_pills = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posts.single.infinite-post-load');
    }
}
