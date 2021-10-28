<?php

namespace Modules\Comment\Http\Controllers;

use DB, File, Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\{ PostSetting, Post, PostsTag, PostsMeta };
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Comment\Entities\Comment;
use Modules\Comment\Entities\Reply;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $bladeTemplate = $request->ajax() ? 'comment::partials.table' : 'comment::index';

        $status = $request->input('Status') ? $request->input('Status') : 'published';
        $limit  = $request->input('limit') ? $request->input('limit') : 25;
        
        // $comments = DB::select(DB::raw("SELECT c.id as id, u.username as comment_user, c.comment as comment, c.status as comment_status, p.title as title, p.slug as slug, c.created_at as comment_created_at, r.comment_id, r.reply as reply , r.reply_user as reply_user, r.reply_status as reply_status, r.reply_created_at as reply_created_at 
        //                         FROM comments c 
        //                         LEFT JOIN posts p ON c.post_id = p.id
        //                         LEFT JOIN users u ON c.user_id = u.id
        //                         LEFT JOIN (SELECT cr.comment_id as comment_id, cr.content as reply, u.username as reply_user, cr.status as reply_status, cr.created_at as reply_created_at FROM comment_reply cr LEFT JOIN users u ON cr.user_id = u.id) r ON c.id = r.comment_id
        //                         WHERE c.status = '$status' OR r.reply_status = '$status'
        //                         ORDER BY comment_created_at DESC
        //                         "));
        // $comments = Comment::hydrate($comments);
        $comments = Comment::with('user', 'post')->orderBy('created_at', 'desc')->get();
        $replies = Reply::with('user')->where('status', '=', $status)->orderBy('created_at', 'desc')->get();
        foreach($comments as $comment) {
            $comment->replies = [];
            $temp = [];
            foreach($replies as $reply) {
                if($comment->id == $reply->comment_id) {
                    array_push($temp, $reply);
                    $comment->replies = $temp;
                } 
            }
        }
        $availableLimit = ['25', '50', '100', '150', '200'];

        // counters
        $comments_all_count = Comment::where('status', '=', 'published')->count() + Reply::where('status', '=', 'published')->count();
        $comments_suspended_count = Comment::where('status', '=', 'draft')->count() + Reply::where('status', '=', 'draft')->count();
        $comments_trash_count = Comment::where('status', '=', 'deleted')->count() + Reply::where('status', '=', 'deleted')->count();

        return view( 
            $bladeTemplate,
            compact('comments', 'limit', 'availableLimit', 'comments_all_count', 'comments_suspended_count', 'comments_trash_count', 'request', 'status')
        );
    }

    public function edit($id)
    {
        $comments = Comment::where('id', '=', $id)->first();
        if (!$comments) {
            return redirect('admin/comment')->with('responseMessage', 'Comment not found.');
        }
        return view('components.posts.edit-post-form', compact('comments'))->withoutShortcodes();
    }

    public function update(Request $request, $id)
    {
        $response = 'Comment' . $id . ' has been updated.';
        // $post = DB::table('posts')->where('id', '=', $id)->first();
        $comments = Comment::find($id);

        if (!$comments) {
            return redirect('admin/comment')->with('responseMessage', 'Comment not found.');
        }

        // get inputs
        $description = $request->input('description');
        
        // save updated user
        $comments->comment = $description;
        $saved = $comments->save();

        if (!$saved) {
            // $responseMessage = 'Failed to save details. Please try again.';
            $response = [
                'status'  => 'error',
                'message' => 'Failed to save details. Please try again.',
            ];
        }

        // return response()->json($response);
        return back()->with('responseMessage', $response);
    }

    public function draft($id)
    {
        $responseMessage = 'Comment has been suspended.';
        $comments = Comment::find($id);
        if ($comments) {
            $comments->status = 'draft';
            $comments->save();

            $responseMessage = 'Comment ' . $comments->id . ' has been suspended.';
            $responseMessage .= '</br>';
            
        } else {
            $responseMessage .= 'Comment with ID: ' . $id . 'is not found.';
            $responseMessage .= '</br>';
        }

        return back()->with('responseMessage', $responseMessage);
    }

    public function delete($id)
    {
        $responseMessage = 'Comment has been deleted.';
        $comments = Comment::find($id);
        if ($comments) {
            $comments->status = 'deleted';
            $comments->save();

            $responseMessage = 'Comment ' . $comments->id . ' has been deleted.';
            $responseMessage .= '</br>';
            
        } else {
            $responseMessage .= 'Comment with ID: ' . $id . 'is not found.';
            $responseMessage .= '</br>';
        }

        return back()->with('responseMessage', $responseMessage);
    }

    public function replyEdit($id)
    {
        $comments = Reply::where('id', '=', $id)->first();
        if (!$comments) {
            return redirect('admin/comment')->with('responseMessage', 'Reply not found.');
        }
        return view('components.posts.edit-comment-reply', compact('comments'))->withoutShortcodes();
    }

    public function replyUpdate(Request $request, $id)
    {
        $response = 'Comment reply' . $id . ' has been updated.';
        // $post = DB::table('posts')->where('id', '=', $id)->first();
        $replies = Reply::find($id);

        if (!$replies) {
            return redirect('admin/comment')->with('responseMessage', 'Comment not found.');
        }

        // get inputs
        $description = $request->input('description');
        
        // save updated user
        $replies->content = $description;
        $saved = $replies->save();

        if (!$saved) {
            // $responseMessage = 'Failed to save details. Please try again.';
            $response = [
                'status'  => 'error',
                'message' => 'Failed to save details. Please try again.',
            ];
        }

        // return response()->json($response);
        return back()->with('responseMessage', $response);
    }

    public function replyDraft($id)
    {
        $responseMessage = 'Comment has been suspended.';
        $replies = Reply::find($id);
        if ($replies) {
            $replies->status = 'draft';
            $replies->save();

            $responseMessage = 'Comment reply ' . $replies->id . ' has been suspended.';
            $responseMessage .= '</br>';
            
        } else {
            $responseMessage .= 'Comment reply with ID: ' . $id . 'is not found.';
            $responseMessage .= '</br>';
        }

        return back()->with('responseMessage', $responseMessage);
    }

    public function replyDelete($id)
    {
        $responseMessage = 'Comment has been deleted.';
        $replies = Reply::find($id);
        if ($replies) {
            $replies->status = 'deleted';
            $replies->save();

            $responseMessage = 'Comment reply ' . $replies->id . ' has been deleted.';
            $responseMessage .= '</br>';
            
        } else {
            $responseMessage .= 'Comment reply with ID: ' . $id . 'is not found.';
            $responseMessage .= '</br>';
        }

        return back()->with('responseMessage', $responseMessage);
    }

    public function multiDelete(Request $request)
    {
        $selectedIDs = $request->input('selectedIDs');
        $loggedInUser = auth()->user();
        $responseMessage = '';

        // if nothing is selected just return
        if ($selectedIDs == null) {
            return back();
        }

        foreach ($selectedIDs as $key => $id) {
            if (explode('-', $id)[0] == 'comment') {
                $comments = Comment::find(explode('-', $id)[1]);
            } else {
                $comments = Reply::find(explode('-', $id)[1]);
            }

            if ($comments) {
                $comments->status = 'deleted';
                $comments->save();

                $responseMessage .= 'All Comments have been deleted.';
                $responseMessage .= '</br>';
                
            } else {
                $responseMessage .= 'Comment is not found.';
                $responseMessage .= '</br>';
            }
        }

        return back()->with('responseMessage', $responseMessage);
    }   
    
    public function emptyTrash()
    {
        // Get posts on trash
        $trashed_comments = Comment::where('status', 'deleted')->get();
        
        foreach ($trashed_comments as $comment) {
            // $trashed_comment = DB::table('comments')->where('post_id', $post->id);
            // $trashed_posttag = PostsTag::where('post_id', $post->id);
            // $trashed_comment->delete();
            // $trashed_posttag->delete();
            $comment->delete();
        }

        $trashed_replies = Reply::where('status', 'deleted')->get();
        
        foreach ($trashed_replies as $reply) {
            // $trashed_comment = DB::table('comments')->where('post_id', $post->id);
            // $trashed_posttag = PostsTag::where('post_id', $post->id);
            // $trashed_comment->delete();
            // $trashed_posttag->delete();
            $reply->delete();
        }

        return redirect('admin/comment');
    }
}
