<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ShippingRateServiceInterface;
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
     * ShippingRateController constructor.
     * @param ShippingRateServiceInterface $shippingRateService
     */
    public function __construct(ShippingRateServiceInterface $shippingRateService)
    {
        $this->shippingRateService = $shippingRateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        return response()->json($result, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
