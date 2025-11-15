<?php

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Get all users",
 *     @OA\Response(response=200, description="List of users")
 * )
 */
Flight::route('GET /users', function() {
    Flight::json(Flight::userService()->get_all());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="User info")
 * )
 */
Flight::route('GET /users/@id', function($id) {
    Flight::json(Flight::userService()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Create user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"full_name","email","password"},
 *             @OA\Property(property="full_name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="secret123"),
 *             @OA\Property(property="role", type="string", example="user"),
 *             @OA\Property(property="meal_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(response=200, description="User created")
 * )
 */
Flight::route('POST /users', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add($data));
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Update user",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="full_name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string"),
 *             @OA\Property(property="role", type="string"),
 *             @OA\Property(property="meal_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User updated")
 * )
 */
Flight::route('PUT /users/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Delete user",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="User deleted")
 * )
 */
Flight::route('DELETE /users/@id', function($id) {
    Flight::json(Flight::userService()->delete($id));
});
?>
