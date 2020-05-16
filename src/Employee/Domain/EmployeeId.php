<?php

declare(strict_types=1);

namespace Src\Employee\Domain;


final class EmployeeId
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        if ($id < 0) {
            throw new IdNotFound($id);
        }

        $this->id = $id;
    }
}
