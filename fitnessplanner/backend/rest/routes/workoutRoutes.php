<?php

/**
 * @OA\Get(
 *     path="/workouts",
 *     tags={"Workouts"},
 *     summary="Get all workout plans",
 *     @OA\Response(response=200, description="List of workouts")
 * )
 */
Flight::route('GET /workouts', function() {
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
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(response=200, description="Workout details")
 * )
 */
Flight::route('GET /workouts/@id', function($id) {
    Flight::json(Flight::workoutService()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/workouts",
 *     tags={"Workouts"},
 *     summary="Create workout plan",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title","difficulty"},
 *             @OA\Property(property="title", type="string", example="Push Day"),
 *             @OA\Property(property="description", type="string", example="Chest, Shoulders, Triceps"),
 *             @OA\Property(property="difficulty", type="string", example="medium"),
 *             @OA\Property(property="duration_weeks", type="integer", example=6)
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout plan created")
 * )
 */
Flight::route('POST /workouts', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::workoutService()->add($data));
});

/**
 * @OA\Put(
 *     path="/workouts/{id}",
 *     tags={"Workouts"},
 *     summary="Update workout plan",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="difficulty", type="string"),
 *             @OA\Property(property="duration_weeks", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout updated")
 * )
 */
Flight::route('PUT /workouts/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::workoutService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/workouts/{id}",
 *     tags={"Workouts"},
 *     summary="Delete workout plan",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="Workout deleted")
 * )
 */
Flight::route('DELETE /workouts/@id', function($id) {
    Flight::json(Flight::workoutService()->delete($id));
});
?>
