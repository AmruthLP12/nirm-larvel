<?php

namespace Obii\Visitors\Http\Middleware;

use Obii\Visitors\Models\Visitors;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $cacheKey = 'visitors_' . $request->ip() . '_' . Carbon::now()->toDateString();
        cache()->remember($cacheKey, 60 * 24, function () use ($request) {
            $exists = Visitors::whereRaw('date(visited_at) = ?', [Carbon::now()->toDateString()])
                ->where('ip_address', $request->ip())
                ->exists();
            if (!$exists) {
                $user_agent = $request->header('User-Agent');
                $user_agent = substr($user_agent, 0, 191);
                Visitors::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => $user_agent,
                    'visited_at' => Carbon::now()
                ]);
            }
        });
        
        return $next($request);
    }
}
