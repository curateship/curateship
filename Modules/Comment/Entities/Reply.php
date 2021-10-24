<?php

namespace Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table = 'comment_reply';
    public function comment()
    {
    	return $this->belongsTo(\Modules\Users\Entities\Comment::class, 'comment_id');
    }

    public function user()
    {
    	return $this->belongsTo(\Modules\Users\Entities\User::class, 'user_id');
    }
}
