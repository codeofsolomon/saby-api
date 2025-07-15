<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

final readonly class Schedule
{
    /** @var ExceptionSchedule[] */
    public array $exceptionSchedule;

    /** @var MainSchedule[] */
    public array $mainSchedule;

    public function __construct(
        array $exceptionSchedule,
        public int $finishTime,
        array $mainSchedule,
        public int $startTime,
        /** @var int[] */
        public array $workDays,
    ) {
        $this->exceptionSchedule = $exceptionSchedule;
        $this->mainSchedule = $mainSchedule;
    }

    /**
     * @param array{
     *   exceptionSchedule: array<array>,
     *   finish_time: int,
     *   mainSchedule: array<array>,
     *   start_time: int,
     *   work_days: int[]
     * } $data
     */
    public static function fromArray(array $data): self
    {
        $exceptions = [];
        foreach ($data['exceptionSchedule'] ?? [] as $item) {
            $exceptions[] = ExceptionSchedule::fromArray($item);
        }

        $mains = [];
        foreach ($data['mainSchedule'] ?? [] as $item) {
            $mains[] = MainSchedule::fromArray($item);
        }

        return new self(
            exceptionSchedule: $exceptions,
            finishTime: (int) ($data['finish_time'] ?? 0),
            mainSchedule: $mains,
            startTime: (int) ($data['start_time'] ?? 0),
            workDays: $data['work_days'] ?? [],
        );
    }
}
