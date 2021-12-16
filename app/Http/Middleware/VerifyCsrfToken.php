<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // Laravel does not return correct CSRF tokens for "dynamic" pages, so we need to exclude these two comments routes from checking;
        '/post/comment/save',
        '/post/comment/reply-save/'
    ];
}
