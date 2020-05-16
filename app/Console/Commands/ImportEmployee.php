<?php

namespace App\Console\Commands;

use App\Employee;
use Illuminate\Console\Command;
use Src\Employee\Application\UpdateSalaryUseCase;
use Src\Employee\Infrastructure\EloquentEmployeeRepository;
use Src\Employee\Infrastructure\InFileEmployeeRepository;

final class ImportEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:employee {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contact importer';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $filename = $this->argument('filename');

        // Obtengo los empleados
        $employees = $this->readCsv($filename);

        $useCase = new UpdateSalaryUseCase(new InFileEmployeeRepository());

        foreach ($employees as $employee) {
            $useCase->execute(
                $employee['id'],
                $employee['hoursWorked']
            );
        }

        // Muestra mensaje de finalización
        $this->info('All rows were imported.');
    }

    private function readCsv(string $filename, string $delimiter = ','): array
    {
        $data = [];
        if (($fp = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($fp, 1000, $delimiter)) !== FALSE) {
                $data[] = $row;
            }
            fclose($fp);
        }

        return $data;
    }

}
