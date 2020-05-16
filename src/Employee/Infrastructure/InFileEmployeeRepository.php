<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure;


use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;

final class InFileEmployeeRepository implements EmployeeRepository
{

    public function search(EmployeeId $employeeId): array
    {
        // TODO: Implement search() method.
    }

    public function save(EmployeeEntity $employee): void
    {
        if (($fp = fopen('another-file.csv', 'w')) !== FALSE) {
            foreach ( $employee->toArray() as $dato) {
                fputcsv($fp, $dato);
            }

            fclose($fp);
        }
    }
}
