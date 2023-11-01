<?php
declare(strict_types=1);

namespace App\Http\Responses;

use App\Http\Enums\EnumHttpResponseStatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class StandardApiResponse // extends JsonResponse
{
    private EnumHttpResponseStatusCode $response_status_code;
    private array $data;

    public function __construct(
        EnumHttpResponseStatusCode $response_status_code = EnumHttpResponseStatusCode::OK,
        bool $success = true,
        array $data = [],
        array $errors = [],
    )
    {
        $this->data = [
            'data' => $data,
            'data_count' => count($data),
            'success' => $success,
            'errors' => $errors,
            'error_count' => count($errors),
        ];

        $this->response_status_code = $response_status_code;
        /// parent::__construct($success, $data, $errors);
    }

    public function JsonResponse(): JsonResponse
    {
        return Response::json(
            $this->data
        , $this->response_status_code->value);
    }
}
