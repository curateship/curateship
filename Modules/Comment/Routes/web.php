<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::get('comment', 'CommentController@index');
    Route::get('comment/edit/{id}', 'CommentController@edit');
    Route::get('comment/draft/{id}', 'CommentController@draft');
    Route::get('comment/delete/{id}', 'CommentController@delete');
    Route::post('comment/update/{id}', 'CommentController@update');
    Route::get('reply-comment/edit/{id}', 'CommentController@replyEdit');
    Route::get('reply-comment/draft/{id}', 'CommentController@replyDraft');
    Route::get('reply-comment/delete/{id}', 'CommentController@replyDelete');
    Route::post('reply-comment/update/{id}', 'CommentController@replyUpdate');

    Route::put('/comment/update', [
    'as' => 'admin.comment.update',
    'uses' => 'CommentController@update'
    ]);

    Route::post('/comment/trash/empty', 'CommentController@emptyTrash');

    Route::post('comment/bulk-delete', 'CommentController@multiDelete');
});

Route::get('post/comment/get/{post_id}', [
    'as'   => 'post-comment-get',
    'uses' => 'CommentController@getPostComments'
]);

Route::get('post/comment/reply/', [
    'as'   => 'post-comment-reply',
    'uses' => 'CommentController@reply'
]);

Route::post('post/comment/reply-save/', [
    'as'   => 'post-comment-reply-save',
    'uses' => 'CommentController@saveReply'
]);

Route::post('post/comment/save', [
    'as'   => 'post-comment-save',
    'uses' => 'CommentController@saveComment'
]);
