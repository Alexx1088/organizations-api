<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationsByActivityResource;
use App\Models\Activity;

class ActivityController extends Controller
{
   public function organizationsByActivity( $activity_id): \Illuminate\Http\JsonResponse
   {
       $activity = Activity::findOrFail($activity_id);

       $organizations = $activity->organization()->paginate(10);

       return response()->json([
           'activity' => $activity->name,
           'organizations' => OrganizationsByActivityResource::collection($organizations)->response()->getData(true),
       ]);

   }

}
