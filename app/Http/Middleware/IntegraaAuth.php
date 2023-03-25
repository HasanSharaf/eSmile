<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Engine\Auth\AuthManager;
use App\Helpers\Classes\PermissionHolder;
use Illuminate\Support\Facades\Http;
use App\Helpers\Classes\Response;
use Modules\User\Entities\User as EntitiesUser;

class IntegraaAuth
{
    use Response;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
      
        if (!$token)
            return $this->responseError(null, 'Not Authorized', true, 401);

        //check if user is auth in auth service
        $response = Http::withToken($token)->withHeaders([
                'authToken' => $request->headers->get('authToken'),
            ])
            ->asForm()->post('https://api-auth.production.integraa.net/api/auths/check', []);
           
        $status = $response->json()['status'];
        $data = $response->json()['data'];
        if ($status != 200)
            return $this->responseError(null, 'Not Authorized', true, 401);
        $user = EntitiesUser::where('integraa_id', $data['integraa_id'])->first();
        if (!$user) {
            return $this->responseError(null, 'Not Authorized', true, 401);
        }
        Auth::login($user);
        $instance = PermissionHolder::getInstance();
        $instance->setPermissions($data['userPermissions']);

        return $next($request);
    }
}
