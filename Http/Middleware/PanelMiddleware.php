<?php

declare(strict_types=1);

namespace Modules\Xot\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Str;
use Modules\Xot\Services\PanelService;

//use Illuminate\Http\Response;

/**
 * Class PanelMiddleware.
 */
class PanelMiddleware {
    /*
    public function __construct(array $params){
        dddx($params);
    }
    */

    /**
     * @return \Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next) {
        //$parameters = request()->route()->parameters();
        $parameters = optional(\Route::current())->parameters();
        try {
            $panel = PanelService::getByParams($parameters);
        } catch (\Exception $e) {
            //return response()->view('theme::errors.404', ['message' => $e->getMessage(), 'lang' => 'it'], 404);
            return response()->view('theme::errors.404', ['message' => $e->getMessage(), 'lang' => 'it'], 404);
        }

        PanelService::setRequestPanel($panel);

        return $next($request);
    }
}
