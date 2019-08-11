<?php


namespace App\Repositories\Interfaces;

use App\Exceptions\ShippingException;

interface ShippingRepositoryInterface
{
    /**
     * @param null $record
     * @return bool
     * @throws ShippingException
     */
    public function create($record = null): ?bool;

    /**
     * @param int $id
     * @return array|null
     */
    public function findOne(int $id): ?array;

    /**
     * @return mixed
     */
    public function findAll(): ?array;

    /**
     * @param int $id
     * @param object $record
     * @return mixed
     */
    public function update(int $id, $record = null);

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
