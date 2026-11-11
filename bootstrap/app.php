<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->dontFlash('g-recaptcha-response');

        $exceptions->render(function (HttpExceptionInterface $exception, Request $request) {
            if ($request->routeIs('admin.logout') && ! $request->expectsJson()
                && $exception->getPrevious() instanceof TokenMismatchException) {
                return to_route('admin.logout.confirm', status: 303)
                    ->with('pesan', 'Silakan klik Keluar lagi untuk mengakhiri sesi.');
            }
        });

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
