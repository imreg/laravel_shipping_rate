<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\ShippingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShippingController extends Controller
{
    /**
     * @var ShippingServiceInterface
     */
    private $shippingService;

    public function __construct(ShippingServiceInterface $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->shippingService->read();
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $result = $this->shippingService->read($id);
        return response()->json($result);
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
        $validation = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'price' => 'required|integer',
                    'weight' => 'required|integer',
                    'country_code' => 'required|string|size:2',
                    'shipping_fee' => 'required|integer',
                    'total' => 'integer',
                ]
            );

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()->messages()], Response::HTTP_BAD_REQUEST);
        }

        $params = [
            'price' => $request->get('price'),
            'weight' => $request->get('weight'),
            'country_code' => $request->get('country_code'),
            'shipping_fee' => $request->get('shipping_fee'),
            'total' => $request->get('total')
        ];

        $result = $this->shippingService->update($id, $params);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $result = $this->shippingService->delete($id);
        return response()->json($result);
    }
}
