<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ShippingRepositoryInterface;
use App\Shipping;

class ShippingRepository implements ShippingRepositoryInterface
{
    /**
     * @var Shipping
     */
    private $shipping;

    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @inheritDoc
     * @throws \Throwable
     */
    public function create($record = null): ?bool
    {
        $shipping = new Shipping();
        $shipping->price = $record->price ?? 0;
        $shipping->weight = $record->weight ?? 0;
        $shipping->country_code = $record->country_code ?? '';
        $shipping->shipping_fee = $record->shipping_fee ?? 0;
        $shipping->total = $record->total ?? 0;
        return $shipping->saveOrFail();
    }

    /**
     * @inheritDoc
     */
    public function findOne(int $id): ?array
    {
        return $this->shipping
            ->where('id', '=', $id)->take(1)
            ->get()
            ->toArray();
    }

    /**
     * @inheritDoc
     */
    public function findAll(): ?array
    {
        return $this->shipping
            ->get()
            ->toArray();
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, $record = null)
    {
        $shipping = Shipping::find($id);

        $shipping->price = $record->price ?? 0;
        $shipping->weight = $record->weight ?? 0;
        $shipping->country_code = $record->country_code ?? '';
        $shipping->shipping_fee = $record->shipping_fee ?? 0;
        $shipping->total = $record->total ?? 0;

        return $shipping->saveOrFail();
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->shipping
            ->where('id', '=', $id)
            ->delete();
    }
}
