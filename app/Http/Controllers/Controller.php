<?php

namespace App\Http\Controllers;
/**
 * /**
 * @OA\Info(title="API", version="0.1")
 *
 * @OA\Get(
 *     path="/api/resource.json",
 *     @OA\Response(response="200", description="An example resource")
 * )
 *
 * @SWG\Swagger(
 *   basePath="/api",
 *   @SWG\Info(
 *     title="Core API",
 *     version="1.0.0"
 *   )
 *
 *  @OA\Schema(
 *      schema="ValidationErrors",
 *      type="object",
 *      @OA\Property(property="message", type="string"),
 *      @OA\Property(property="errors", type="object",
 *        @OA\Property(property="field", type="array",
 *           @OA\Items(type="string")
 *        ),
 *      ),
 *      @OA\Property(property="status_code", type="integer"),
 *   ),
 *
 *  @OA\Schema(
 *      schema="Error",
 *      type="object",
 *      @OA\Property(property="message", type="string"),
 *      @OA\Property(property="status_code", type="integer"),
 *   ),
 *
 *   @OA\Schema(
 *    schema="PaginationResponse",
 *    type="object",
 *     allOf={
 *       @OA\Schema(type="object", ref="#/components/schemas/Pagination"),
 *    },
 *   ),
 *
 *  @OA\Schema(
 *      schema="Pagination",
 *      type="object",
 *      @OA\Property(property="total", type="integer"),
 *      @OA\Property(property="count", type="integer"),
 *      @OA\Property(property="per_page", type="integer"),
 *      @OA\Property(property="current_page", type="integer"),
 *      @OA\Property(property="total_pages", type="integer"),
 *      @OA\Property(property="links", type="array", @OA\Items(type="string")),
 *   )
 * )
 *
 * @package App\Http\Controllers
 */
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
