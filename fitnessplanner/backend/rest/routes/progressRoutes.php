<?php

/**
 * @OA\Get(
 *     path="/progress",
 *     tags={"Progress"},
 *     summary="Get all progress entries",
 *     @OA\Response(
 *         response=200,
 *         description="List of all progress entries"
 *     )
 * )
 */
Flight::route('GET /progress', function() {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::progressService()->get_all());
});


/**
 * @OA\Get(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Get a single progress entry by ID",
 *     @OA\Parameter(
 *         name="id",
 *         description="Progress entry ID",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Progress entry details"
 *     )
 * )
 */
Flight::route('GET /progress/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
    Flight::json(Flight::progressService()->get_by_id($id));
});


/**
 * @OA\Post(
 *     path="/progress",
 *     tags={"Progress"},
 *     summary="Create a new progress entry",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "log_date", "weight"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="log_date", type="string", example="2025-01-10"),
 *             @OA\Property(property="weight", type="number", example=72.5),
 *             @OA\Property(property="notes", type="string", example="Feeling good today")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Progress entry successfully created"
 *     )
 * )
 */
Flight::route('POST /progress', function() {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::progressService()->add($data));
});


/**
 * @OA\Put(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Update an existing progress entry",
 *     @OA\Parameter(
 *         name="id",
 *         description="Progress entry ID",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="weight", type="number", example=74.2),
 *             @OA\Property(property="notes", type="string", example="Updated note")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Progress entry updated"
 *     )
 * )
 */
Flight::route('PUT /progress/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::progressService()->update($id, $data));
});


/**
 * @OA\Delete(
 *     path="/progress/{id}",
 *     tags={"Progress"},
 *     summary="Delete a progress entry",
 *     @OA\Parameter(
 *         name="id",
 *         description="Progress entry ID",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Progress entry deleted"
 *     )
 * )
 */
Flight::route('DELETE /progress/@id', function($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::progressService()->delete($id));
});

?>
