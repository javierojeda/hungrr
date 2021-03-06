<?php
/**
 * Created by PhpStorm.
 * User: PIX
 * Date: 24/03/2016
 * Time: 01:43 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Auth;

class ApiController extends Controller
{

    protected $statusCode = HTTPResponse::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    protected function respondFound($data, $headers = [])
    {
        $user = Auth::user();
        $auth_token = generate_token($user);
        $headers['token'] = $auth_token;
        return $this->respond($data, $headers);
    }

    protected function respondCreated($message = 'Created!')
    {
        $user = Auth::user();
        $token = generate_token($user);
        return $this->setStatusCode(HTTPResponse::HTTP_CREATED)->respondWithSuccess($message, $token);
    }

    protected function respondWithConflict($message = 'Conflictive Entity!')
    {
        return $this->setStatusCode(HTTPResponse::HTTP_CONFLICT)->respondWithError($message);
    }

    protected function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(HTTPResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    protected function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(HTTPResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    protected function respondValidationFailure($message = 'Invalid Params!')
    {
        return $this->setStatusCode(HTTPResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    protected function respondNotAuthorized($message = 'Wrong credentials!')
    {
        return $this->setStatusCode(HTTPResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }

    private function respondWithError($message)
    {
        return $this->respond(
            [
                'error' => [
                    'message' => $message,
                    'status_code' => $this->getStatusCode()
                ]
            ],
            [
                'Content-Type' => 'application/json'
            ]
        );
    }

    private function respondWithSuccess($message, $token)
    {
        return $this->respond(
            [
                'success' => [
                    'message' => $message,
                    'status_code' => $this->getStatusCode(),
                ]
            ],
            [
                'Content-Type' => 'application/json',
                'token' => $token
            ]
        );
    }

    private function respond($data, $headers)
    {
        $response = Response::json($data, $this->getStatusCode(), $headers, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $response;
    }

}
