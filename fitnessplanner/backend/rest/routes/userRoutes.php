<?php

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Get all users (Admin only)",
 *     @OA\Response(
 *         response=200,
 *         description="List of all users"
 *     )
 * )
 */
Flight::route('GET /users', function() {
    Flight::auth_middleware()->authorizeRole("admin");
    Flight::json(Flight::userService()->get_all());
});


/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Get user by ID",
 *     description="Admin can access any user. Regular users can access only their own account.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User information"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden — user tried to access another user's data"
 *     )
 * )
 */
Flight::route('GET /users/@id', function($id) {

    $user = Flight::get('user'); // JWT payload

    if ($user->role !== "admin" && $user->id != $id) {
        Flight::halt(403, "You can only access your own profile.");
    }

    Flight::json(Flight::userService()->get_by_id($id));
});


/**
 * @OA\Post(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Create a new user (Admin only)",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "full_name"},
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="full_name", type="string", example="John Doe"),
 *             @OA\Property(property="role", type="string", example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully created"
 *     )
 * )
 */
Flight::route('POST /users', function() {
    Flight::auth_middleware()->authorizeRole("admin");

    $data = Flight::request()->data->getData();

    if (empty($data['email']) || empty($data['full_name'])) {
        Flight::halt(400, "Email and full_name are required.");
    }

    Flight::json(Flight::userService()->add($data));
});


/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Update user information",
 *     description="Admin can update any user. Regular users can update only their own account.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="email", type="string", example="newemail@example.com"),
 *             @OA\Property(property="full_name", type="string", example="Updated Name"),
 *             @OA\Property(property="role", type="string", example="user")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function($id) {

    $loggedUser = Flight::get('user');

    if ($loggedUser->role !== "admin" && $loggedUser->id != $id) {
        Flight::halt(403, "You may update only your own profile.");
    }

    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->update($id, $data));
});


/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Delete a user (Admin only)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="User ID",
 *         required=true,
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function($id) {
    Flight::auth_middleware()->authorizeRole("admin");
    Flight::json(Flight::userService()->delete($id));
});

?>
