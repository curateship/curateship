<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed|string|null $user_id
 * @property mixed $theme
 */
class UsersSetting extends Model
{
    protected $guarded = ['id'];
}
