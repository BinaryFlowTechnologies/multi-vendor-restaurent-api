<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
  /**
   * Send response with success true
   *
   * @param array $data
   * @param string $message
   * @param int $statusCode
   * @return JsonResponse
   */
  public function sendResponse ($data, string $message = '', int $statusCode = 200): JsonResponse
  {
	$response = [
		'data'    => $data,
		'message' => $message,
		'success' => true,
	];

	return response()->json($response, $statusCode);
  }

  /**
   * Send response with success false
   *
   * @param string $error
   * @param array $errorMessages
   * @param int $statusCode
   * @return JsonResponse
   */

  public function sendError (string $error, array $errorMessages = [], int $statusCode = 404): JsonResponse
  {
	$response = [
		'success' => false,
		'message' => $error,
	];

	if (!empty($errorMessages)) {
	  $response[ 'data' ] = $errorMessages;
	}

	return response()->json($response, $statusCode);
  }


}
