<?php

namespace App\View\Components\Posts\Single;

use Illuminate\View\Component;

use Modules\Post\Entities\{Post, PostsMeta};
use Modules\Comment\Entities\Comment;
use Modules\Comment\Entities\Reply;
use Carbon\Carbon;

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
        $post = Post::leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->select([
                'posts.id as id',
                'users.username as post_username',
                'posts.title as title',
                'posts.description',
                'posts.status as post_status',
                'posts.created_at as created_at'
            ])
            ->where(
                [
                    'posts.id'        => $id,
                    'posts.status'    => 'published'
                ]
        )->first();

        if ($post) {

            $post['description'] = Post::parseContent($post['description']);
            $post['seo_title'] = $post['title'] . ' | [sitetitle]';
            $post['url'] = 'post/' . $post['slug'];

            $video_file          = PostsMeta::getMetaData( $post->id, 'video' );
            $video_extension     = empty( $video_file ) ? '' : substr($video_file, strrpos($video_file,".") + 1);
            $post['video']       = !empty( $video_file ) ? asset("storage/posts/original/{$video_file}") : '';
            $post['video_type']  = $video_extension == 'mp4' ? 'video/mp4' : ( $video_extension == 'webm' ? 'video/webm' : '' );
            
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
                                        'comments.post_id' => $id,
                                    ]
                                )->get();
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
                                )->get();
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
            $post['comments'] = $comments;
            $this->post = $post;
            $this->tag_pills = $post->getTagNames();

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
