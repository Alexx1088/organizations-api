<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationByRectangleRequest;
use App\Http\Resources\OrganizationByIdResource;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function organizationsByRectangle(OrganizationByRectangleRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $minLat = $data['min_latitude'];
        $maxLat = $data['max_latitude'];
        $minLng = $data['min_longitude'];
        $maxLng = $data['max_longitude'];

        $organizations = Organization::whereHas('building', function ($query)
        use ($minLat, $maxLat, $minLng, $maxLng) {
            $query->whereBetween('latitude', [$minLat, $maxLat])
                ->whereBetween('longitude', [$minLng, $maxLng]);
        })->paginate(10);

        if ($organizations->isEmpty()) {
            return response()->json(['message' => 'No organizations found within the specified area.'], 200);
        }

return response()->json([
    'organizations' => OrganizationResource::collection($organizations)->response()->getData(true),
]);
    }

    public function organizationById(int $organization_id): \Illuminate\Http\JsonResponse
    {
        $organization = Organization::with(['building', 'activities', 'phones'])->findOrFail($organization_id);

        return response()->json([
            new OrganizationByIdResource($organization),
        ]);
    }
}
