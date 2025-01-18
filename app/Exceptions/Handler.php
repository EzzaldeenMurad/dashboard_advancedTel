<?php

namespace App\Exceptions;

use App\Http\Traits\ApiResponseTrait as TraitsApiResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use TraitsApiResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $exception)
    {

        // if ($request->expectsJson() || $request->is('api/*')) {
        //     return $this->handleApiException($exception);
        // }

        // return $this->handleWebException($exception);

        // if ($exception instanceof RouteNotFoundException || $exception instanceof NotFoundHttpException) {
        //     return  $this->apiResponse(null, 'Route not found', Response::HTTP_NOT_FOUND); //response()->view('errors.route-not-found', [], 404);
        // }
        // if ($exception instanceof MethodNotAllowedHttpException) {
        //     return $this->apiResponse(null, $exception->getMessage(), Response::HTTP_METHOD_NOT_ALLOWED);
        // }

        // if ($exception instanceof ModelNotFoundException) {
        //     return $this->apiResponse(null, 'Model not found', Response::HTTP_NOT_FOUND);
        // }
        // if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        //     return  response()->redirect('/');
        // }

        // if ($exception instanceof AuthorizationException) {
        //     return response()->json([
        //         'error' => 'Unauthorized action.',
        //     ], 403);
        // }
        return parent::render($request, $exception);
    }

    // private function handleApiException(Throwable $exception)
    // {
    //     $statusCode = $this->getStatusCode($exception);
    //     $message = $this->getErrorMessage($exception, $statusCode);

    //     return $this->apiResponse(null, $message, $statusCode);
    // }
    // private function handleWebException(Throwable $exception)
    // {
    //     $statusCode = $this->getStatusCode($exception);

    //     return response()->view("errors.$statusCode", [], $statusCode);
    // }
    // private function getStatusCode(Throwable $exception)
    // {
    //     return method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
    // }


    // private function getErrorMessage(Throwable $exception, $statusCode)
    // {
    //     return match ($statusCode) {
    //         Response::HTTP_NOT_FOUND        => 'Resource not found.',
    //         Response::HTTP_FORBIDDEN       => 'Access denied.',
    //         Response::HTTP_UNAUTHORIZED    => 'Unauthorized access.',
    //         Response::HTTP_METHOD_NOT_ALLOWED => 'Method not allowed.',
    //         default                        => 'An unexpected error occurred.',
    //     };
    // }
}
