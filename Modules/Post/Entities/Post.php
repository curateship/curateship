<?php

namespace Modules\Post\Entities;

use Carbon\Carbon;
use File;
use Illuminate\Database\Eloquent\Model;

use Modules\Admin\Entities\Settings;
use Modules\Comment\Entities\Comment;
use Modules\Comment\Entities\Reply;
use Modules\Post\Entities\{PostsMeta, PostsTag};
use Modules\Tag\Entities\{Tag, TagCategory};

/**
 * @property string|void $description
 * @property string $video
 * @property string $video_type
 * @property string $seo_title
 * @property mixed $slug
 * @property string $url
 * @property mixed $title
 * @property mixed $id
 * @property mixed $postsTag
 * @property mixed $thumbnail
 * @property mixed $thumbnail_medium
 * @property $comments
 */
class Post extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(\Modules\Users\Entities\User::class);
    }

    public function getThumbnail($type = 'original')
    {
        $post = Post::find($this->id);
    	if($type == 'original' && $this->thumbnail) {
    		return asset('storage/posts/original') . '/' . $post->thumbnail;
    	}

    	if($type == 'medium' && $this->thumbnail_medium) {
    		return storage_path() . '/app/public/posts/thumbnail/' . $this->thumbnail_medium;
    	}

        return false;
    }

    public function showThumbnail($type = 'original')
    {
    	if($type == 'original'){
    		return asset('storage/posts/original') . '/' . $this->thumbnail;
    	}

    	if($type == 'medium'){
    		return asset('storage/posts/thumbnail') . '/' . $this->thumbnail_medium;
    	}
	}

    public function showVideo($video_file)
    {
        $video_mobile = storage_path() . '/app/public/videos/mobile/' . $video_file;
        if (isMobileDevice() && File::exists($video_mobile)) {
            return asset('storage/videos/mobile') . '/' . $video_file;
        } else {
            return asset('storage/videos/original') . '/' . $video_file;
        }
	}

	public function postsTag()
    {
        return $this->hasMany(PostsTag::class);
	}

    public static function getByTagCategoryName($tag_category_query = null, $limit = null)
    {

        $tag_category = TagCategory::where('name', $tag_category_query)->first();

        // If tag category is not found -> return 404 | Not Found
        if (!$tag_category_query || !$tag_category) {
            return [];
        }

        // Get tags that use the tag category
        $tags       = Tag::where('tag_category_id', $tag_category->id)->get();

        // Get middle table `posts_tags`
        $posts_tags = PostsTag::all();

        // Get only items from `posts_tags` that is on `tags`
        $filtered_posts_tags = $posts_tags->filter(function($post_tag, $key) use ($tags){
                return $tags->contains($post_tag->tag_id);
        });

        // Convert `posts_tags` collection to `posts`
        $posts = $filtered_posts_tags->map(function($post_tag, $key){
                return $post_tag->post; // via `belongsTo` method
        });

        $posts = $posts->unique()->sortByDesc('created_at')->where('status', 'published');

        if ($limit) {
            $posts = $posts->slice(0, $limit);
        }

        $posts = $posts->all();

        foreach($posts as $post) {
            $post->PrepareDataForShow();
        }

        return $posts;
    }

    public static function getByTagNames($tags = [], $limit = 5)
    {

        $posts = Post::leftJoin('posts_tags', 'posts_tags.post_id', '=', 'posts.id')
            ->leftJoin('tags', 'tags.id', '=', 'posts_tags.tag_id')
            ->selectRaw('posts.*')
            ->whereIn('tags.name', $tags)
            ->where('posts.status', 'published')
            ->orderBy('posts.created_at', 'DESC')
            ->groupBy([
                'posts.id',
                'posts.user_id',
                'posts.title',
                'posts.description',
                'posts.thumbnail',
                'posts.thumbnail_medium',
                'posts.created_at',
                'posts.updated_at',
                'posts.slug',
                'posts.post_type',
                'posts.status'
                ]);

/*
        !!! THIS IS STUPID PEACE OF SHIT !!!

        $tags_collection = Tag::whereIn('name', $tags)->get();

        // Get middle table `posts_tags`
        $posts_tags = PostsTag::all();

        // Get only items from `posts_tags` that is on `tags`
        $filtered_posts_tags = $posts_tags->filter(function($post_tag, $key) use ($tags_collection){
            return $tags_collection->contains($post_tag->tag_id);
        });

        // Convert `posts_tags` collection to `posts`
        $posts = $filtered_posts_tags->map(function($post_tag, $key){
            return $post_tag->post; // via `belongsTo` method
        });

        $posts = $posts->unique()->sortByDesc('created_at')->where('status', 'published');
*/

        if ($limit) {
            $posts = $posts->limit($limit);
        }

        $posts = $posts->get();

        foreach($posts as $post) {
            if($post->post_type == 'video'){
                $post->PrepareDataForShow();
            }
        }

        return $posts;
    }

    public function getTagCategoryNames()
    {
        $tag_categories = TagCategory::all();
        $posts_tags     = $this->postsTag;

        $category_names = [];

        foreach ($tag_categories as $key => $tag_category) {
            $show_category = false;

            foreach($posts_tags as $post_tag){
                $tag = Tag::find($post_tag->tag_id);

                if($tag->tag_category_id === $tag_category->id){
                    $show_category = true;
                    break;
                }
            }

            if($show_category){
                array_push($category_names, $tag_category->name);
            }
        }

        return $category_names;
    }

    public function getTagNames()
    {
        $posts_tags = $this->postsTag;
        $tags       = [];

        foreach($posts_tags as $post_tag){
            $tag = Tag::find($post_tag->tag_id);

            array_push($tags, $tag->name);
        }

        return $tags;

    }

    public static function parseContent($data = null, $excerpt = false) {
        if (!$data) {
            return;
        }

        $excerpt = ($excerpt == true) ? true : false;

        $data   = json_decode($data);
        $html   = $excerpt ? self::getExcerptHTML($data) : self::getHTML($data);
        return $html;
    }

    public static function getHTML($data)
    {
        $html = '';

        if (isset($data->blocks)) {
            $blocks = $data->blocks;

            foreach ($blocks as $key => $block) {
                switch ($block->type) {
                    case 'paragraph':
                        $html .= self::getParagraph($block->data);
                        break;
                    case 'header':
                        $html .= self::getHeader($block->data);
                        break;
                    case 'delimiter':
                        $html .= self::getHorizontalLine($block->data);
                        break;
                    case 'image':
                        $html .= self::getImage($block->data);
                        break;
                    case 'list';
                        $html .= self::getOrderedList($block->data);
                        break;
                    case 'checklist':
                        $html .= self::getCheckList($block->data);
                        break;
                    case 'raw':
                        $html .= self::getRawHTML($block->data);
                        break;
                    case 'quote':
                        $html .= self::getQuote($block->data);
                        break;
                    default:
                        $html .= '';
                        break;
                }
            }
        }

        return $html;
    }

    public static function getExcerptHTML($data)
    {
        if (isset($data->blocks)) {
            $blocks = $data->blocks;

            foreach ($blocks as $key => $block) {
                if ($block->type == 'paragraph') {
                    // Return only the first paragraph content
                    return self::getParagraph($block->data);
                }
            }
        }

        return '';

    }

    public static function getParagraph($block_data)
    {
        if (!$block_data) {
            return;
        }

        $block_text = $block_data->text;

        // Replace `<b>` tags
        $block_text = str_replace('<b>', '<strong>', $block_text);
        $block_text = str_replace('</b>', '</strong>', $block_text);

        // Replace `<i>` tags
        $block_text = str_replace('<i>', '<em>', $block_text);
        $block_text = str_replace('</i>', '</em>', $block_text);

        $html = '
            <p>' . $block_text . '</p>
        ';

        return $html;
    }

    public static function getHeader($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = '
            <h' . $block_data->level . '>' . $block_data->text . '</h' . $block_data->level . '>
        ';

        return $html;
    }

    public static function getHorizontalLine($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = '<hr />';

        return $html;
    }

    public static function getImage($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = '
            <figure class="margin-bottom-md">
                <img src="' . $block_data->file->url . '" />
                <figcaption>' . $block_data->caption . '</figcaption>
            </figure>
        ';

        return $html;
    }

    public static function getOrderedList($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = '<ol>';
            foreach ($block_data->items as $key => $item) {
                $html .= '<li>' . $item . '</li>';
            }
        $html .= '</ol>';

        return $html;
    }

    public static function getCheckList($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = '<ul>';
            foreach ($block_data->items as $key => $item) {
                $line_through_class = ($item->checked) ? 'text-line-through' : '';

                $html .= '<li class="' . $line_through_class . '">' . $item->text . '</li>';
            }
        $html .= '</ul>';

        return $html;
    }

    public static function getRawHTML($block_data)
    {
        if (!$block_data) {
            return;
        }

        $html = $block_data->html;

        return $html;
    }

    public static function getQuote($block_data)
    {
        if (!$block_data) {
            return;
        }

        $block_text    = $block_data->text;
        $block_caption = $block_data->caption;
        $alignment     = $block_data->alignment;

        $html = '
            <blockquote class="position-relative z-index-1 bg-contrast-lower text-center padding-y-xxl" style="text-align: ' . $alignment . '">
            <div class="container max-width-adaptive-sm">
              <svg class="icon icon--xxl color-contrast-low" aria-hidden="true" viewBox="0 0 64 64"><polygon fill="currentColor" points="2 36 17 2 26 2 15 36 26 36 26 62 2 62 2 36"/><polygon fill="currentColor" points="38 36 53 2 62 2 51 36 62 36 62 62 38 62 38 36"/></svg>
              <div class="text-component margin-top-lg">
                <p class="text-xl">' . $block_text . '</p>
              </div>
              <footer class="margin-top-lg">&mdash; ' . $block_caption . '</footer>
            </div>
          </blockquote>
        ';

        return $html;
    }

    public function PrepareDataForShow(){
        $this->description = Post::parseContent($this->description);
        $video_file = PostsMeta::getMetaData( $this->id, 'video' );
        $video_extension = empty( $video_file ) ? '' : substr($video_file, strrpos($video_file,".") + 1);

        $video_mobile = storage_path() . '/app/public/videos/mobile/' . $video_file;
        if (isMobileDevice() && File::exists($video_mobile)) {
            $this->video    = !empty( $video_file ) ? asset("storage/videos/mobile/{$video_file}") : '';
        } else {
            $this->video    = !empty( $video_file ) ? asset("storage/videos/original/{$video_file}") : '';
        }

        $this->video_type  = $video_extension == 'mp4' ? 'video/mp4' : ( $video_extension == 'webm' ? 'video/webm' : '' );
        $this->seo_title   = $this->title . ' | [sitetitle]';
        $this->url = 'post/' . $this->slug;
    }

    public function preparePostComments(){
        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->leftJoin('users_settings', 'comments.user_id', '=', 'users_settings.user_id')
            ->select([
                'comments.id as comment_id',
                'comments.comment as comment',
                'users.username as comment_user',
                'users_settings.avatar as avatar',
                'comments.status as comment_status',
                'comments.created_at as comment_created_at'
            ])
            ->where(
                [
                    'comments.post_id' => $this->id,
                ]
            )->orderBy('comments.created_at', 'desc')->get();
        foreach($comments as $comment) {
            $from = new Carbon($comment->comment_created_at);
            $diff_in_days = Carbon::now()->diffForHumans($from, true). ' ago';
            $comment['comment_created_at'] = $diff_in_days;

            $replies = Reply::leftJoin('users', 'comment_reply.user_id', '=', 'users.id')
                ->leftJoin('users_settings', 'comment_reply.user_id', '=', 'users_settings.user_id')
                ->select([
                    'comment_reply.id as reply_id',
                    'users.username as reply_user',
                    'users_settings.avatar as reply_avatar',
                    'comment_reply.content as reply_content',
                    'comment_reply.created_at as reply_created_at',
                    'comment_reply.status as $reply_status'
                ])
                ->where(
                    [
                        'comment_reply.comment_id' => $comment->comment_id,
                        'comment_reply.status' => 'published'
                    ]
                )->orderBy('comment_reply.created_at', 'desc')->get();
            $repliesCount = Reply::leftJoin('users', 'comment_reply.user_id', '=', 'users.id')
                ->leftJoin('users_settings', 'comment_reply.user_id', '=', 'users_settings.user_id')
                ->select([
                    'comment_reply.id as reply_id',
                    'users.username as reply_user',
                    'users_settings.avatar as reply_avatar',
                    'comment_reply.content as reply_content',
                    'comment_reply.created_at as reply_created_at'
                ])
                ->where(
                    [
                        'comment_reply.comment_id' => $comment->comment_id,
                        'comment_reply.status' => 'published'
                    ]
                )->count();
            $comment['repliesCount'] = $repliesCount;
            foreach($replies as $reply) {
                $from = new Carbon($reply->reply_created_at);
                $diff_in_days = Carbon::now()->diffForHumans($from, true) . ' ago';
                $reply['reply_created_at'] = $diff_in_days;
            }
            $comment['replies'] = $replies;
        }
        $this->comments = $comments;
    }

    public function comment()
    {
    	return $this->hasMany(\Modules\Comment\Entities\Comment::class);
    }

    static public function autoTitle($request){
        // Get title template;
        $template = json_decode(Settings::where('key', 'title_template')->first()->value, true);
        // Render title from tags;
        $title_array = [];
        $str_block_count = 0;
        foreach ($template as $template_item) {
            if (!isset($template_item['category_id'])) {
                $title_array[] = implode($template_item);
                $str_block_count++;
                continue;
            }

            $cat_request_name = 'tag_category_' . $template_item['category_id'];
            if ($request->has($cat_request_name)) {
                $cat_in_request = $request->input($cat_request_name);
                $rand_array = [];
                $limit = min($template_item['limit'], count($cat_in_request));
                for ($i = 0; $i < $limit ; $i++) {
                    if(is_numeric($cat_in_request[$i])){
                        $tag = Tag::find($cat_in_request[$i]);
                        if($tag !== null) $rand_array[] = $tag->name;
                    }   else{
                        $rand_array[] = $cat_in_request[$i];
                    }
                }
                if (count($rand_array) > 0) {
                    $title_array[] = implode(' ', $rand_array);
                }
            }
        }

        $title = implode($title_array);

        if (count($title_array) == $str_block_count) {
            // No tags? Get filename;
            $title = $request->original_filename;
        }


        return strip_tags($title);
    }
}

