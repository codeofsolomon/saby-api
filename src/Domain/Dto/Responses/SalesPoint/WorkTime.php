<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

final readonly class WorkTime
{
    public function __construct(
        public ?Schedule $schedule,
        public ?string $start,
        public ?string $stop,
        /** @var int[] */
        public array $workdays,
    ) {}

    /**
     * @param array{
     *   schedule: array,
     *   start: string,
     *   stop: string,
     *   workdays: int[]
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            schedule: Schedule::fromArray($data['schedule'] ?? []),
            start: (string) ($data['start'] ?? ''),
            stop: (string) ($data['stop'] ?? ''),
            workdays: $data['workdays'] ?? [],
        );
    }
}
