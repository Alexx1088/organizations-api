<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use App\Http\Resources\OrganizationsByActivityResource;
use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
   public function organizationsByActivity(int $activity_id): \Illuminate\Http\JsonResponse
   {
       $activity = Activity::findOrFail($activity_id);

       $organizations = $activity->organization()->paginate(10);

       return response()->json([
           'activity' => $activity->name,
           'organizations' => OrganizationsByActivityResource::collection($organizations)->response()->getData(true),
       ]);

   }

    public function organizationsByActivityTree(Request $request, int $activity_id): \Illuminate\Http\JsonResponse
    {
        $activity = Activity::with('children')->findOrFail($activity_id);

        $descendantIds = $this->getAllDescendantIds($activity);

        $descendantIds[] = $activity->id;

        $organizations = Organization::whereHas('activities', function ($query) use ($descendantIds) {
           $query->whereIn('activities.id', $descendantIds);
        })->paginate(10);

        return response()->json([
            'activity' => $activity->name,
            'organizations' => OrganizationResource::collection($organizations)->response()->getData(true),
        ]);
    }

    public function getAllDescendantIds($activity): array
    {
        $ids = [];

        foreach ($activity->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getAllDescendantIds($child));
        }

        return $ids;
    }

}
