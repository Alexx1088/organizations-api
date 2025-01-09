<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use App\Models\Building;

class BuildingController extends Controller
{
    public function getOrganizations(int $id): \Illuminate\Http\JsonResponse
    {
        $building = Building::with('organizations')->find($id);

        if (!$building) {
            return response()->json(['error' => 'Building not found'], 404);
        }

        $organizations = $building->organizations()->paginate(10);

        return response()->json([
            'building' => $building->address,
            'organizations' => OrganizationResource::collection($organizations)->response()->getData(true),
        ]);

    }
}
