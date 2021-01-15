<?php

namespace App\Shortcodes;
use Modules\Admin\Entities\Post;

class PostTitleShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    $post = Post::find($shortcode->id);

    if (!$post) {
      return '';
    }

    return sprintf('%s', $post->title);
  }
}
