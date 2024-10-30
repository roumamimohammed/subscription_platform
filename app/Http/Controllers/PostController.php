<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use App\Services\PostService;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Subscription Platform API Documentation",
 *      description="API for managing posts and subscriptions"
 * )
 */
class PostController extends Controller
{
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * @OA\Post(
     *     path="/api/website/{id}/post",
     *     summary="Create a new post",
     *     description="Creates a new post for a specific website",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Website ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Website not found"
     *     )
     * )
     */
    public function store(Request $request, $websiteId)
    {
        $post = $this->postService->createPost($websiteId, $request->all());

        return response()->json($post, 201);
    }
}
