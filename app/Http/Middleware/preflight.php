<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class preflight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       // return $next($request);

       $headers = [
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'X-Requested-With, X-Auth-Token, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding, X-Login-Origin,X-CSRF-TOKEN, X-Requested-With, token',
       // 'Access-Control-Allow-Credentials' => 'true',
        
                 ];

    if ($request->isMethod("OPTIONS")) {
        // The client-side application can set only headers allowed in Access-Control-Allow-Headers
        return Response::make('OK', 200, $headers);
    }
    //$request->headers->set('Accept', 'application/json');
    $response = $next($request);

    foreach ($headers as $key => $value) {
        $response->header($key, $value);
    }
     return $response;  

    }







    
}
