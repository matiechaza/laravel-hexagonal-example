<?php

declare(strict_types=1);

namespace Src\Employee\Domain;


final class EmployeeEntity
{
    private EmployeeId $id;
    private Hours $hoursWorker;
    private Money $salary;
    private Money $pricePerHour;

    public function __construct(EmployeeId $id, Hours $hoursWorker, Money $pricePerHour)
    {
        $this->id = $id;
        $this->hoursWorker = $hoursWorker;
        $this->pricePerHour = $pricePerHour;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new EmployeeId($data['id']),
            new Hours($data['hoursWorker']),
            new Money($data['pricePerHour'])
        );
    }

    public function calculateSalary(Hours $hoursWorker): void
    {
        $this->salary = new Money(
            $this->pricePerHour->value() * $hoursWorker->getHours()
        );
    }

    /**
     * @return EmployeeId
     */
    public function id(): EmployeeId
    {
        return $this->id;
    }

    /**
     * @return Hours
     */
    public function hoursWorker(): Hours
    {
        return $this->hoursWorker;
    }

    /**
     * @return Money
     */
    public function salary(): Money
    {
        return $this->salary;
    }

    /**
     * @return Money
     */
    public function pricePerHour(): Money
    {
        return $this->pricePerHour;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'hoursWorker' => $this->hoursWorker()->getHours(),
            'salary' => $this->salary()->value(),
            'pricePerHours' => $this->pricePerHour()->value()
        ];
    }
}
