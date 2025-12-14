<?php

/**
 * @OA\Get(
 *     path="/mealplans/test",
 *     tags={"Meal Plans"},
 *     summary="Test meal plan route",
 *     @OA\Response(response=200, description="Meal plan test works")
 * )
 */
Flight::route('GET /mealplans/test', function() {
    echo "MEALPLAN ROUTE WORKS!";
});


/**
 * @OA\Get(
 *     path="/mealplans",
 *     tags={"Meal Plans"},
 *     summary="Get all meal plans",
 *     @OA\Response(
 *         response=200,
 *         description="List of all meal plans"
 *     )
 * )
 */
Flight::route('GET /mealplans', function() {
    Flight::auth_middleware()->authorizeRoles(["admin", "user"]);
    Flight::json(Flight::mealService()->get_all());
});


/**
 * @OA\Get(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Get meal plan by ID",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="Meal plan ID",
 *          @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Meal plan data"
 *     )
 * )
 */
Flight::route('GET /mealplans/@id', function($id) {
    Flight::auth_middleware()->authorizeRoles(["admin", "user"]);
    Flight::json(Flight::mealService()->get_by_id($id));
});


/**
 * @OA\Post(
 *     path="/mealplans",
 *     tags={"Meal Plans"},
 *     summary="Create a new meal plan",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *              required={"title", "type"},
 *              @OA\Property(property="title", type="string", example="High Protein Plan"),
 *              @OA\Property(property="type", type="string", example="Protein focused"),
 *              @OA\Property(property="calories", type="integer", example=1800),
 *              @OA\Property(property="description", type="string", example="Healthy meal plan for building muscle")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Meal plan successfully created"
 *     )
 * )
 */
Flight::route('POST /mealplans', function() {
    Flight::auth_middleware()->authorizeRole("admin");

    $data = Flight::request()->data->getData();

    if (empty($data["title"]) || empty($data["type"])) {
        Flight::halt(400, "Title and type are required.");
    }

    Flight::json(Flight::mealService()->add($data));
});


/**
 * @OA\Put(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Update an existing meal plan",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="Meal plan ID",
 *          @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Updated Meal Plan"),
 *              @OA\Property(property="type", type="string", example="Balanced"),
 *              @OA\Property(property="calories", type="integer", example=1900),
 *              @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Meal plan updated successfully"
 *     )
 * )
 */
Flight::route('PUT /mealplans/@id', function($id) {
    Flight::auth_middleware()->authorizeRole("admin");

    $data = Flight::request()->data->getData();
    Flight::json(Flight::mealService()->update($id, $data));
});


/**
 * @OA\Delete(
 *     path="/mealplans/{id}",
 *     tags={"Meal Plans"},
 *     summary="Delete a meal plan",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="Meal plan ID",
 *          @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Meal plan deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /mealplans/@id', function($id) {
    Flight::auth_middleware()->authorizeRole("admin");
    Flight::json(Flight::mealService()->delete($id));
});

?>
