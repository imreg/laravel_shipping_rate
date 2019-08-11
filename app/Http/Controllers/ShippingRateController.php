<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ShippingRateServiceInterface;
use App\Services\Interfaces\ShippingServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShippingRateController extends Controller
{
    /**
     * @var ShippingRateServiceInterface
     */
    private $shippingRateService;

    /**
     * @var ShippingServiceInterface
     */
    private $shippingService;

    /**
     * ShippingRateController constructor.
     * @param ShippingRateServiceInterface $shippingRateService
     */
    public function __construct(
        ShippingRateServiceInterface $shippingRateService,
        ShippingServiceInterface $shippingService
    ) {
        $this->shippingRateService = $shippingRateService;
        $this->shippingService = $shippingService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $validation = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'price' => 'required|integer',
                    'weight' => 'required|integer',
                    'country_code' => 'required|string|size:2',
                ]
            );

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()->messages()], Response::HTTP_BAD_REQUEST);
        }

        $result = $this->shippingRateService->calculate(
            $request->price,
            $request->weight,
            strtoupper($request->country_code)
        );

        $storeResult = null;

        if (isset($result['error']) === false) {
            $storeResult = $this->shippingService->create($result);
        }

        if (isset($storeResult['error']) === true) {
            return response()->json($storeResult, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($result, Response::HTTP_OK);
    }
}
