<?php

/**
 * @OA\Get(
 *     path="/mealplans",
 *     tags={"Meal Plans"},
 *     summary="Get all meal plans",
 *     @OA\Response(response=200, description="List of all meal plans")
 * )
 */
Flight::route('GET /mealplans', function() {
    Flight::json(Flight::mealService()->get_all());
});

/**
 * @OA\Get(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Get meal plan by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer", example=1)),
 *     @OA\Response(response=200, description="Meal plan data")
 * )
 */
Flight::route('GET /mealplans/@id', function($id) {
    Flight::json(Flight::mealService()->get_by_id($id));
});

/**
 * @OA\Post(
 *     path="/mealplans",
 *     tags={"Meal Plans"},
 *     summary="Create a meal plan",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title","type"},
 *             @OA\Property(property="title", type="string", example="Keto Diet"),
 *             @OA\Property(property="type", type="string", example="Low-carb"),
 *             @OA\Property(property="calories", type="integer", example=1800),
 *             @OA\Property(property="description", type="string", example="Weekly keto diet meal plan")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Meal plan created")
 * )
 */
Flight::route('POST /mealplans', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::mealService()->add($data));
});

/**
 * @OA\Put(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Update meal plan",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="type", type="string"),
 *             @OA\Property(property="calories", type="integer"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Meal plan updated")
 * )
 */
Flight::route('PUT /mealplans/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::mealService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Delete meal plan",
 *     @OA\Parameter(name="id", in="path", required=true),
 *     @OA\Response(response=200, description="Meal plan deleted")
 * )
 */
Flight::route('DELETE /mealplans/@id', function($id) {
    Flight::json(Flight::mealService()->delete($id));
});
?>
