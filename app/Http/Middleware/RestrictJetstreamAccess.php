<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictJetstreamAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorizedEmails = [
            'directeur@gmail.com',
            'sabi@gmail.com',
            'mounir@gmail.com',
        ];
    
        if (!$request->user() || !in_array($request->user()->email, $authorizedEmails)) {
            return redirect('/'); // Redirect unauthorized users to a different page
        }
    
        return $next($request);    }
}
