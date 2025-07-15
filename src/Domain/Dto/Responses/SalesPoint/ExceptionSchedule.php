<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

final readonly class ExceptionSchedule
{
    public function __construct(
        public ?int $breakStartTime,
        public ?int $breakEndTime,
        /** @var string[] */
        public array $exceptionIntervalDates,
        public string $name,
        public ?int $workStartTime,
        public ?int $workEndTime,
    ) {}

    /**
     * @param array{
     *   breakStartTime: int|null,
     *   breakEndTime: int|null,
     *   exceptionIntervalDates: string[],
     *   name: string,
     *   workStartTime: int|null,
     *   workEndTime: int|null
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            breakStartTime: isset($data['breakStartTime']) ? (int) $data['breakStartTime'] : null,
            breakEndTime: isset($data['breakEndTime']) ? (int) $data['breakEndTime'] : null,
            exceptionIntervalDates: $data['exceptionIntervalDates'] ?? [],
            name: (string) $data['name'],
            workStartTime: isset($data['workStartTime']) ? (int) $data['workStartTime'] : null,
            workEndTime: isset($data['workEndTime']) ? (int) $data['workEndTime'] : null,
        );
    }
}
