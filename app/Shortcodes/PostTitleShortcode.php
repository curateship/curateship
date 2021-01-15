<?php

namespace App\Shortcodes;
use Modules\Post\Entities\Post;

class PostTitleShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    // parse current url: url path should be LOCALE/POST_SLUG in this case
    $url = parse_url(url()->current());
    $paths = explode("/", trim($url['path'], "/"));
    $post_slug = $paths[count($paths) - 1];
    $locale = $paths[count($paths) - 2];

    // validate $locale
    preg_match('/[a-zA-Z]{2}/', $locale, $matches);
    if (count($matches) > 0 && count($paths) == 2) {
      // get post by slug
      $post = Post::firstWhere('slug', $post_slug);

      if (!$post) {
        return '';
      }

      return $post->title;
    }

    return '';
  }
}
