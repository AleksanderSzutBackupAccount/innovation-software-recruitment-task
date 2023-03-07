<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    protected ResponseFactory $factory;

    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(Request $request, Closure $next): JsonResponse
    {
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);
        $response->headers->set('Content-Type', 'application/json');

        if (!$response instanceof JsonResponse) {
            $response = $this->factory->json(
                $response->content(),
                $response->status(),
                $response->headers->all()
            );
        }

        return $response;
    }
}
