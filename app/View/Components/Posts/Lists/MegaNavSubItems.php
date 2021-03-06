<?php

namespace App\View\Components\Posts\Lists;

use Illuminate\View\Component;

use Modules\Post\Entities\Post;

class MegaNavSubItems extends Component
{
    public $posts;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = '', $tags = [], $limit = 5)
    {
        $posts = [];

        if ($tags) {
            $posts = Post::getByTagNames($tags, $limit);
        }else{
            // Else if not set, then just get latest posts
            $posts = Post::where(
                [
                    'status' => 'published'
                ]
            )
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset(0)
            ;

            $posts = $posts->get();
        }

        $this->label = $label;
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.mega-nav-sub-items');
    }
}
