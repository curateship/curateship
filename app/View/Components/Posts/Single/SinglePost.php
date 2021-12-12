<?php

namespace App\View\Components\Posts\Single;

use File;
use Illuminate\View\Component;

use Modules\Post\Entities\{Post, PostsMeta};

class SinglePost extends Component
{
    public $post;

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
            $post->PrepareDataForShow();
        }

        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posts.single.single-post');
    }
}
