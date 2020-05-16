<?php

declare(strict_types=1);

namespace Src\Employee\Application;


use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\Hours;

final class UpdateSalaryUseCase
{
    private FindEmployeeUseCase $finder;
    private EmployeeRepository $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new FindEmployeeUseCase($this->repository);
    }

    public function execute(int $id, int $hoursWorked): void
    {
        $employee = $this->finder->execute($id);

        $employee->calculateSalary(new Hours($hoursWorked));

        $this->repository->save($employee);
    }
}
