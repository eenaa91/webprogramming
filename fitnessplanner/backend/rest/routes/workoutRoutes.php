<?php

/**
 * @OA\Get(
 *     path="/workouts",
 *     tags={"Workouts"},
 *     summary="Get all workouts (Admin + User)",
 *     @OA\Response(
 *         response=200,
 *         description="List of workouts"
 *     )
 * )
 */
Flight::route('GET /workouts', function() {
    Flight::auth_middleware()->authorizeRoles(["admin", "user"]);
    Flight::json(Flight::workoutService()->get_all());
});


/**
 * @OA\Get(
 *     path="/workouts/{id}",
 *     tags={"Workouts"},
 *     summary="Get workout by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Workout ID",
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Workout details"
 *     )
 * )
 */
Flight::route('GET /workouts/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles(["admin", "user"]);
    Flight::json(Flight::workoutService()->get_by_id($id));
});


/**
 * @OA\Post(
 *     path="/workouts",
 *     tags={"Workouts"},
 *     summary="Create new workout (Admin only)",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "difficulty"},
 *             @OA\Property(property="title", type="string", example="Full Body Strength"),
 *             @OA\Property(property="difficulty", type="string", example="Intermediate"),
 *             @OA\Property(property="duration_minutes", type="integer", example=45),
 *             @OA\Property(property="description", type="string", example="Focuses on compound movements")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Workout created successfully"
 *     )
 * )
 */
Flight::route('POST /workouts', function() {
    Flight::auth_middleware()->authorizeRole("admin");

    $data = Flight::request()->data->getData();

    if (empty($data["title"]) || empty($data["difficulty"])) {
        Flight::halt(400, "Title and difficulty are required.");
    }

    Flight::json(Flight::workoutService()->add($data));
});


/**
 * @OA\Put(
 *     path="/workouts/{id}",
 *     tags={"Workouts"},
 *     summary="Update workout (Admin only)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Workout ID",
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated Workout Name"),
 *             @OA\Property(property="difficulty", type="string", example="Advanced"),
 *             @OA\Property(property="duration_minutes", type="integer", example=60),
 *             @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Workout updated"
 *     )
 * )
 */
Flight::route('PUT /workouts/@id', function($id) {
    Flight::auth_middleware()->authorizeRole("admin");

    $data = Flight::request()->data->getData();
    Flight::json(Flight::workoutService()->update($id, $data));
});


/**
 * @OA\Delete(
 *     path="/workouts/{id}",
 *     tags={"Workouts"},
 *     summary="Delete workout (Admin only)",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Workout ID",
 *         @OA\Schema(type="integer", example=4)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Workout deleted"
 *     )
 * )
 */
Flight::route('DELETE /workouts/@id', function($id) {
    Flight::auth_middleware()->authorizeRole("admin");
    Flight::json(Flight::workoutService()->delete($id));
});

?>
