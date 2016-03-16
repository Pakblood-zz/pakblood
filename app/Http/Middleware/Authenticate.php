<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (\Auth::check()) {
            $redirect = (\Auth::user()->username) ? \Auth::user()->username : \Auth::user()->id;
            if ((\Request::is('admin') || \Request::is('admin/*')) && (\Auth::user()->role != 'admin')) {
                return redirect("profile/" . $redirect)->with('message', 'You are not authorized to view that page.')
                    ->with('type', 'error');
            }
            if ((\Request::is('profile') || \Request::is('profile/*')) && (\Auth::user()->role != 'user')) {
                return redirect("admin")->with('message', 'You are not authorized to view that page.')
                    ->with('type', 'error');
            }
        }
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }
            else {
                return redirect()->guest('/login');
            }
        }

        return $next($request);
    }
}
