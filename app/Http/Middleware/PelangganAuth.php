<?php

namespace App\Http\Middleware;

use Closure;

class PelangganAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
       if($user->isPelanggan()){
        return $next($request);
    }else{
            return redirect()->back(); //kembali ke halaan sebelumnya
        }
    }
    }

