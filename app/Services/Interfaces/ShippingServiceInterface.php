<?php


namespace App\Services\Interfaces;

interface ShippingServiceInterface
{
    /**
     * @param array $shipping
     * @return mixed
     */
    public function create(array $shipping);

    /**
     * @param int|null $id
     * @return array|null
     */
    public function read(int $id = null): ?array;

    /**
     * @param int $id
     * @param $array
     * @return mixed
     */
    public function update(int $id, array $array);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
