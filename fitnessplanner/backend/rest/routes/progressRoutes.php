<?php

/**
 * @OA\Get(
 *     path="/progress",
 *     tags={"Progress"},
 *     summary="Get all progress entries",
 *     @OA\Response(response=200, description="List of progress entries")
 * )
 */
Flight::route('GET /progress', function() {
    Flight::json(Flight::progressService()->get_all());
});

/**
 * @OA\Get(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Get progress entry by ID",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="Progress entry details")
 * )
 */
Flight::route('GET /progress/@id', function($id) {
    Flight::json(Flight::progressService()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/progress",
 *     tags={"Progress"},
 *     summary="Create progress entry",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","log_date","weight"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="log_date", type="string", example="2025-01-10"),
 *             @OA\Property(property="weight", type="number", example=72.50),
 *             @OA\Property(property="notes", type="string", example="Feeling good")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Progress created")
 * )
 */
Flight::route('POST /progress', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::progressService()->add($data));
});

/**
 * @OA\Put(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Update progress entry",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="weight", type="number"),
 *             @OA\Property(property="notes", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Progress updated")
 * )
 */
Flight::route('PUT /progress/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::progressService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Delete progress entry",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="Progress deleted")
 * )
 */
Flight::route('DELETE /progress/@id', function($id) {
    Flight::json(Flight::progressService()->delete($id));
});
?>
