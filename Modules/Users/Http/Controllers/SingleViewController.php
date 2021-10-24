<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Page\Entities\Page;
use Modules\Post\Entities\{Post, PostsMeta};
use Modules\Comment\Entities\Comment;
use Modules\Comment\Entities\Reply;
use Illuminate\Support\Facades\Auth;

class SingleViewController extends Controller
{
   public function singlePostView($slug) {
    // Get Post by slug
    $post = Post::firstWhere([
      'slug'      => $slug,
      'status'    => 'published'
    ]);

    if ( !$post ) {
      abort(404);
    }

    $post['description'] = Post::parseContent($post['description']);

    $data['post']       = $post;
    $data['page_title'] = $post->title;
    $video_file          = PostsMeta::getMetaData( $post->id, 'video' );
    $video_extension     = empty( $video_file ) ? '' : substr($video_file, strrpos($video_file,".") + 1);
    $post['video']       = !empty( $video_file ) ? asset("storage/posts/original/{$video_file}") : '';
    $post['video_type']  = $video_extension == 'mp4' ? 'video/mp4' : ( $video_extension == 'webm' ? 'video/webm' : '' );

    return view('templates.layouts.post', $data);
  }

  public function singlePageView($slug) {
    // Get Page by slug
    $page = Page::firstWhere([
      'slug'         => $slug,
      'is_published' => true,
      'is_pending'   => false,
      'is_deleted'   => false,
      'is_rejected'  => false
    ]);

    if ( !$page ) {
      abort(404);
    }

    $page['description'] = Page::parseContent($page['description']);

    $data['page']       = $page;
    $data['page_title'] = $page->title;

    return view('templates.layouts.page', $data);
  }

  public function singleViewbyTheme($theme, $prefix, $slug) {
    if ( $prefix == "page") {
      // Get Page by slug.
      $page = Page::firstWhere([
        'slug'         => $slug,
        'is_published' => true,
        'is_pending'   => false,
        'is_deleted'   => false,
        'is_rejected'  => false
      ]);

      if ( $page ) {
        $page['description'] = Page::parseContent($page['description']);
        
        $data['page']       = $page;
        $data['page_title'] = $page->title;
        $data['theme']      = $theme;

        return view('page::templates.page-template-v1', $data);
      }
    } else if ( $prefix == "post" ) {
      // Get Post by slug.
      $post = Post::firstWhere([
        'slug'      => $slug,
        'status'    => 'published'
      ]);

      if ( $post ) {
        $post['description'] = Post::parseContent($post['description']);
    
        $video_file          = PostsMeta::getMetaData( $post->id, 'video' );
        $video_extension     = empty( $video_file ) ? '' : substr($video_file, strrpos($video_file,".") + 1);
        $post['video']       = !empty( $video_file ) ? asset("storage/posts/original/{$video_file}") : '';
        $post['video_type']  = $video_extension == 'mp4' ? 'video/mp4' : ( $video_extension == 'webm' ? 'video/webm' : '' );
    
        $data['post']       = $post;
        $data['page_title'] = $post->title;
        $data['theme']      = $theme;
    
        return view('post::templates.post-template-v1', $data);    
      }
    }

    abort(404);
  }

  public function reply($id)
    {
      $comment = Comment::where('id', $id)->first();
        return view('components.posts.edit-reply-form', compact('comment'))->withoutShortcodes();
    }

    public function saveReply(Request $request, $id)
    {
        $response = 'Reply according to the comment' . $id . ' has been added.';
        $replyComments = $request->input('comment');
        
        // $post = DB::table('posts')->where('id', '=', $id)->first();
        $replies = Reply::find($id);

        if (!$replies) {
            $exist = Reply::where('content', $replyComments)->first();
            if($exist) {
              return back()->with('responseMessage', 'Reply already exist.');
            } else {
              $content = new Reply;
              $content->user_id = Auth::user()->id;
              $content->comment_id = $id;
              $content->content = $replyComments;
              $content->save();
              $response = 'Save successfully!';
            }
        } else {
          $content = new Reply;
          $content->user_id = Auth::user()->id;
          $content->comment_id = $id;
          $content->content = $replyComments;
          $content->save();
          $response = 'Save successfully!';
        }

        // return response()->json($response);
        return back()->with('responseMessage', $response);
    }

    public function saveComment(Request $request)
    {
      $id = $request->input('postid');
      $comment = $request->input('commentNewContent');
      $user_id = Auth::user()->id;
      $response = 'Comment saved successfully';
      $exist = Comment::where('post_id', $id)
                      ->where('user_id', $user_id)
                      ->where('comment', $comment)
                      ->first();
      if($exist) {
        $response = 'Already exist';
      } else {
        $content = new Comment;
        $content->user_id = $user_id;
        $content->post_id = $id;
        $content->comment = $comment;
        $content->status = 'published';
        $content->save();
        $response = 'Save successfully!';
      }

        // return response()->json($response);
        return back()->with('responseMessage', $response);
    }
}
