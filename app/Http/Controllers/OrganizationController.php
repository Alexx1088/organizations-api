<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationByRectangleRequest;
use App\Http\Requests\SearchOrganizationRequest;
use App\Http\Resources\OrganizationByIdResource;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\OrganizationSearchResource;
use App\Models\Organization;
use Illuminate\Http\Request;

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
        })->with('building')->paginate(10);

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

    public function companySearch(SearchOrganizationRequest $request): \Illuminate\Http\JsonResponse
    {
        $query = $request->input('name');

        $organizations = Organization::where('name', 'like', "%{$query}%")
            ->with('building')
            ->with('activities')
            ->with('phones')
            ->get();

        if ($organizations->isEmpty()) {
            return response()->json(['message' => 'No organizations found matching the given name.']);
        }

        return response()->json([
            'success' => true,
            'data' => OrganizationSearchResource::collection($organizations),
        ]);

    }
}
