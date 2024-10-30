<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Website;
use OpenApi\Annotations as OA;

class SubscriptionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/website/{id}/subscribe",
     *     summary="Subscribe a user to a website",
     *     description="Subscribe a user to receive posts from a specific website",
     *     tags={"Subscriptions"},
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
     *             @OA\Property(property="email", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Subscription created successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Website not found"
     *     )
     * )
     */
    public function store(Request $request, $websiteId)
    {
        $website = Website::findOrFail($websiteId);

        $subscription = Subscription::firstOrCreate([
            'email' => $request->email,
            'website_id' => $website->id,
        ]);

        return response()->json($subscription, 201);
    }
}
