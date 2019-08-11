<?php

namespace App\Services;

use App\Exceptions\ShippingException;
use App\Repositories\Interfaces\ShippingRepositoryInterface;
use App\Services\Interfaces\ShippingServiceInterface;

class ShippingService implements ShippingServiceInterface
{
    /**
     * @var ShippingRepositoryInterface
     */
    private $shippingRepository;

    /**
     * ShippingService constructor.
     * @param ShippingRepositoryInterface $shippingRepository
     */
    public function __construct(ShippingRepositoryInterface $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(array $shipping)
    {
        try {
            $this->shippingRepository->create((object)$shipping);
        } catch (ShippingException $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @inheritDoc
     */
    public function read(int $id = null): ?array
    {
        if ($id === null) {
            return $this->shippingRepository->findAll();
        } else {
            return $this->shippingRepository->findOne($id);
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $array)
    {
        try {
            $this->shippingRepository->update($id, (object)$array);
            return $this->shippingRepository->findOne($id);
        } catch (ShippingException $exception) {
            return ['error' => $exception->getMessage()];
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        try {
            $result = $this->shippingRepository->delete($id);
            return ['id' => $id, 'result' => $result];
        } catch (ShippingException $exception) {
            return ['error' => $exception->getMessage()];
        }
    }
}
