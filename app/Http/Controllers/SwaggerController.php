<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="API Documentation for organizations-api test task",
 *     version="1.0.0",
 *     description="API documentation for the application"
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="api_key",
 *      type="apiKey",
 *      name="Api-key",
 *      in="header",
 *      description="Enter your API key as a Bearer token in the format 'Bearer {your-api-key}'"
 *  )
 *
 *
 * @OA\Tag(
 *     name="Authentication",
 *     description="API Endpoints for Authentication"
 * )
 */
class SwaggerController
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     summary="Login a user",
     *     description="Validate user credentials and return an API key if successful.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login successful"),
     *             @OA\Property(property="api_key", type="string", example="your-api-key")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Invalid credentials")
     *         )
     *     )
     * )


    /**
     * @OA\Get(
     *     path="/api/buildings/{id}/organizations",
     *     tags={"Buildings"},
     *     summary="Get organizations in a building",
     *     description="Retrieve a paginated list of organizations associated with a specific building. Requires an API key.",
     *     security={{"api_key": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the building",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number for pagination",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="building", type="string", example="123 Main St"),
     *             @OA\Property(
     *                 property="organizations",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *
     *                 @OA\Property(property="total", type="integer", example=25)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Building not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Building not found")
     *         )
     *     )
     * )

    /**
     * @OA\Get(
     *     path="/api/activities/{activity_id}/organizations",
     *     tags={"Activities"},
     *     summary="Get organizations by activity",
     *     description="Retrieve a paginated list of organizations associated with a specific activity. Requires an API key.",
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="activity_id",
     *         in="path",
     *         required=true,
     *         description="ID of the activity",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="activity", type="string", example="Activity Name"),
     *             @OA\Property(
     *                 property="organizations",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *
     *                 @OA\Property(property="total", type="integer", example=25)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Activity not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="API key missing or invalid")
     *         )
     *     )
     * )

    /**
     * @OA\Get(
     *     path="/api/organizations/rectangle",
     *     tags={"Organizations"},
     *     summary="Get organizations within a rectangle area",
     *     description="Retrieve a list of organizations within the specified latitude and longitude bounds. Requires an API key.",
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="min_latitude",
     *         in="query",
     *         required=true,
     *         description="Minimum latitude of the rectangle",
     *         @OA\Schema(type="number", format="float", example=37.7749)
     *     ),
     *     @OA\Parameter(
     *         name="max_latitude",
     *         in="query",
     *         required=true,
     *         description="Maximum latitude of the rectangle",
     *         @OA\Schema(type="number", format="float", example=37.8049)
     *     ),
     *     @OA\Parameter(
     *         name="min_longitude",
     *         in="query",
     *         required=true,
     *         description="Minimum longitude of the rectangle",
     *         @OA\Schema(type="number", format="float", example=-122.4194)
     *     ),
     *     @OA\Parameter(
     *         name="max_longitude",
     *         in="query",
     *         required=true,
     *         description="Maximum longitude of the rectangle",
     *         @OA\Schema(type="number", format="float", example=-122.3894)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No organizations found within the specified area",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No organizations found within the specified area.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="API key missing or invalid")
     *         )
     *     )
     * )

    /**
     * @OA\Get(
     *     path="/api/organization/{organization_id}",
     *     tags={"Organizations"},
     *     summary="Get organization by ID",
     *     description="Retrieve details of a specific organization by its ID. Requires an API key.",
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="organization_id",
     *         in="path",
     *         required=true,
     *         description="ID of the organization",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="organization",
     *
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Organization not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Organization not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="API key missing or invalid")
     *         )
     *     )
     * )

    /**
     * @OA\Get(
     *     path="/api/activities/{activity_id}/organizations_list",
     *     tags={"Organizations"},
     *     summary="Get organizations by activity and its descendants",
     *     description="Retrieve a list of organizations associated with the specified activity and its descendant activities. Requires an API key.",
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="activity_id",
     *         in="path",
     *         required=true,
     *         description="ID of the activity",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number for pagination",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             @OA\Property(property="activity", type="string", example="Activity Name"),
     *             @OA\Property(
     *                 property="organizations",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *
     *                 @OA\Property(property="total", type="integer", example=25)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Activity not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="API key missing or invalid")
     *         )
     *     )
     * )

    /**
     * @OA\Get(
     *     path="/api/organizations/search",
     *     tags={"Organizations"},
     *     summary="Search organizations by name",
     *     description="Search for organizations based on the name provided in the query parameter. Requires an API key.",
     *     security={{"api_key": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="Name of the organization to search for",
     *         @OA\Schema(type="string", example="Tech Inc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful search response",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No organizations found matching the given name",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No organizations found matching the given name.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="API key missing or invalid")
     *         )
     *     )
     * )
     */
    public function loginDocumentation()
    {

    }
}
