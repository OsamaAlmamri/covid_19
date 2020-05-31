<?php 

namespace App\Http\Middleware;

use Closure;

//use Illuminate\Foundation\Http\Middleware\SetCharset as Middleware;

class SetCharset
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'multipart/form-data') !== false) {
            $response->header('Content-Type', 'multipart/form-data; charset=UTF-8');
        }

        return $response;
    }
}