<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgeCheck
{

    public function handle(Request $request, Closure $next): Response
    {
        $age = $request->age;
        if($age < 17){
            return response()->json([
                'message' => 'Age should not be less than 18 years',
                'success' =>true
            ]);
        }
        return $next($request);
    }
}
