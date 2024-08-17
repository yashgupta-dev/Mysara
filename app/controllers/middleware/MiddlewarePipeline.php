<?php

// Middleware/MiddlewarePipeline.php
namespace app\controllers\middleware;

class MiddlewarePipeline
{
    private $middlewares = [];

    public function __construct($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    public function handle($request)
    {
        foreach ($this->middlewares as $middleware) {
            // Execute each middleware
            $request = $middleware->handle($request);
        }

        // After all middleware are executed, return the modified request
        return $request;
    }
}
