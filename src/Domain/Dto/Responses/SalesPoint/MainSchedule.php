<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

final readonly class MainSchedule
{
    public function __construct(
        public ?int $breakStartTime,
        public ?int $breakEndTime,
        /** @var array<int|null> Дни недели: 1 — рабочий, null — нерабочий */
        public array $daysOfTheWeek,
        public ?int $workStartTime,
        public ?int $workEndTime,
    ) {}

    /**
     * @param array{
     *   breakStartTime: int|null,
     *   breakEndTime: int|null,
     *   daysOfTheWeek: array<int|null>,
     *   workStartTime: int|null,
     *   workEndTime: int|null
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            breakStartTime: (isset($data['breakStartTime']) ? (int) $data['breakStartTime'] : null),
            breakEndTime: (isset($data['breakEndTime']) ? (int) $data['breakEndTime'] : null),
            daysOfTheWeek: $data['daysOfTheWeek'] ?? [],
            workStartTime: (isset($data['workStartTime']) ? (int) $data['workStartTime'] : null),
            workEndTime: (isset($data['workEndTime']) ? (int) $data['workEndTime'] : null),
        );
    }
}
