<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\GetAddressRequest;
use App\Http\Requests\GetBusinessRequest;
use App\Http\Requests\GetCoordinatesRequest;
use App\Http\Requests\GetOrganizationRequest;
use App\Interfaces\BuildingRepositoryInterface;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\OrganizationRepositoryInterface;

class OrganizationController extends Controller
{
    private BuildingRepositoryInterface $buildingRepositoryInterface;
    private BusinessRepositoryInterface $businessRepository;
    private OrganizationRepositoryInterface $organizationRepository;

    public function __construct(BuildingRepositoryInterface     $buildingRepositoryInterface,
                                BusinessRepositoryInterface     $businessRepository,
                                OrganizationRepositoryInterface $organizationRepository)
    {
        $this->buildingRepositoryInterface = $buildingRepositoryInterface;
        $this->businessRepository = $businessRepository;
        $this->organizationRepository = $organizationRepository;
    }


    /**
     * @OA\Get(
     *     path="/api/organization/address",
     *     operationId="findByAddress",
     *     tags={"findByAddress"},
     *          security={{"api_key":{}}},
     *     summary="Get list of organizations by address",
     *     description="Returns list of buildings with organizations by address",
     *     @OA\Parameter(
     *      description="Address of organzation",
     *      in="query",
     *      name="address",
     *      required=true,
     *      example="suite",
     *      @OA\Schema(
     *         type="string",
     *      )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     * )
     */
    public function findByAddress(GetAddressRequest $request)
    {
        if (empty($request['address'])) return ApiResponseClass::errorResponse();

        $receivedData = $request->validated();

        $data = $this->buildingRepositoryInterface->findByAddress($receivedData['address']);

        return ApiResponseClass::sendResponse($data, '', 200);
    }


    /**
     * @OA\Get(
     *     path="/api/organization/coordinates",
     *     operationId="findByCoordinates",
     *     tags={"findByCoordinates"},
     *          security={{"api_key":{}}},
     *     summary="Get list of organizations by coordinates",
     *     description="Returns list of buildings with organizations by coordinates",
     *     @OA\Parameter(
     *      description="Latitude",
     *      in="query",
     *      name="latitude",
     *      required=true,
     *      example="100.1",
     *      @OA\Schema(
     *         type="number"
     *      )),
     *     @OA\Parameter(
     *       description="Longitude",
     *       in="query",
     *       name="longitude",
     *       required=true,
     *       example="100.1",
     *       @OA\Schema(
     *          type="number"
     *       )),
     *      @OA\Parameter(
     *        description="Distance",
     *        in="query",
     *        name="distance",
     *        required=true,
     *        example="100000.1",
     *        @OA\Schema(
     *           type="number"
     *        )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     * )
     */
    public function findByCoordinates(GetCoordinatesRequest $request)
    {
        $receivedData = $request->validated();
        $data = $this->buildingRepositoryInterface->findByCoordinates($receivedData['latitude'], $receivedData['longitude'], $receivedData ['distance']);
        return $data->isEmpty() ? ApiResponseClass::errorResponse() : ApiResponseClass::sendResponse($data, '', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/organization/building",
     *     operationId="findByBuilding",
     *     tags={"findByBuilding"},
     *          security={{"api_key":{}}},
     *     summary="Get list of organizations by building id",
     *     description="Returns list of buildings with organizations by building id",
     *  @OA\Parameter(
     *     description="ID of building",
     *     in="query",
     *     name="id",
     *     required=true,
     *     example="1",
     *     @OA\Schema(
     *        type="integer",
     *     )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            @OA\Property(property="data", type="object", ref="#/components/schemas/Address")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     * )
     */
    public function findByBuildingId(GetAddressRequest $request)
    {
        $receivedData = $request->validated();
        $data = $this->buildingRepositoryInterface->findByBuilding($receivedData['id']);
        return $data->isEmpty() ? ApiResponseClass::errorResponse() : ApiResponseClass::sendResponse($data, '', 200);
    }


    /**
     * @OA\Get(
     *     path="/api/organization/business",
     *     operationId="findByBusiness",
     *     tags={"findByBusiness"},
     *          security={{"api_key":{}}},
     *     summary="Get list of organizations by business",
     *     description="Returns list of buildings with organizations by business",
     *     @OA\Parameter(
     *      description="Name of the Business type",
     *      in="query",
     *      name="name",
     *      required=true,
     *      example="Еда",
     *      @OA\Schema(
     *         type="string",
     *      )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     *     security={{"bearer":{}}}
     * )
     */
    public function findByBusiness(GetBusinessRequest $request)
    {
        if (empty($request['name'])) return ApiResponseClass::errorResponse();

        $receivedData = $request->validated();
        $data = $this->businessRepository->findByBusiness($receivedData['name']);
        return $data->isEmpty() ? ApiResponseClass::errorResponse() : ApiResponseClass::sendResponse($data, '', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/organization/id",
     *     operationId="findById",
     *     security={{"api_key":{}}},
     *     tags={"findById"},
     *     summary="Get the organization by id",
     *     description="Returns the organization by id",
     *     @OA\Parameter(
     *      description="ID of the Organization",
     *      in="query",
     *      name="id",
     *      required=true,
     *      example="1",
     *      @OA\Schema(
     *         type="integer",
     *         format="int64"
     *      )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            @OA\Property(property="data", type="object", ref="#/components/schemas/FullOrgInfo")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     *     security={{"bearer":{}}}
     * )
     */
    public function findByOrganizationId(GetOrganizationRequest $request)
    {
        $receivedData = $request->validated();
        $data = $this->organizationRepository->findById($receivedData['id']);
        return $data->isEmpty() ? ApiResponseClass::errorResponse() : ApiResponseClass::sendResponse($data, '', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/organization/name",
     *     operationId="findByName",
     *     tags={"findByName"},
     *          security={{"api_key":{}}},
     *     summary="Get the organization by name",
     *     description="Returns the organization by name",
     *     @OA\Parameter(
     *      description="Name of the Organization",
     *      in="query",
     *      name="name",
     *      required=true,
     *      example="inc",
     *      @OA\Schema(
     *         type="string",
     *      )),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *           @OA\Property(property="data", type="object", ref="#/components/schemas/FullOrgInfo")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error",
     *     ),
     *     security={{"bearer":{}}}
     * )
     */
    public function findByOrganizationName(GetOrganizationRequest $request)
    {

        if (empty($request['name'])) return ApiResponseClass::errorResponse();
        $receivedData = $request->validated();
        $data = $this->organizationRepository->findByName($receivedData['name']);
        return $data->isEmpty() ? ApiResponseClass::errorResponse() : ApiResponseClass::sendResponse($data, '', 200);
    }

}
