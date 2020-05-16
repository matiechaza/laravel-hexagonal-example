<?php

declare(strict_types=1);

namespace App\Http\Controllers;


use App\Employee;
use Illuminate\Support\Facades\Request;
use Src\Employee\Application\UpdateSalaryUseCase;
use Src\Employee\Infrastructure\EloquentEmployeeRepository;

final class EmployeerController
{
    public function updateSalary(Request $request)
    {
        /**
        * La validación de inputs ya la resolvemos en los value objects.
        $request->validate([
            'employees.*.id' => 'required|exists:employees',
            'employees.*.hoursWorked' => 'required|min:0',
        ]);
         **/

        // Obtengo los empleados
        $employees = $request->input('employees');

        $useCase = new UpdateSalaryUseCase(new EloquentEmployeeRepository());

        foreach ($employees as $employee) {
            $useCase->execute(
                $employee['id'],
                $employee['hoursWorked']
            );
        }

        // Muestra listado de empleados
        return view('employee.success')->with('success', 'Salaries updated correctly.');
    }
}
