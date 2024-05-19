<?php
/**
 * Enable logging of database queries.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogDatabaseQueries
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
//        if ( !env( 'DB_LOG', false ) ) {
//            return $next( $request );
//        }

//        DB::enableQueryLog();

        DB::listen(function ($query) {
            //  $sql - select * from `ncv_users` where `ncv_users`.`id` = ? limit 1
            //  $bindings - [5]
            //  $time(in milliseconds) - 0.38
             Log::debug( $query->sql . PHP_EOL, [ 'bindings' => $query->bindings, 'time' => $query->time ] );
        });


        $response = $next( $request );
//
//        foreach ( DB::getQueryLog() as $log ) {
//            Log::debug( $log[ 'query' ], [ 'bindings' => $log[ 'bindings' ], 'time' => $log[ 'time' ] ] );
//        }

        return $response;
    }
}