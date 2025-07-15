<?php

declare(strict_types=1);

namespace SabyApi\Domain\Dto\Responses\SalesPoint;

/**
 * Сводка по одной точке продаж
 *
 * @property int $id Идентификатор точки продаж
 * @property string $name Коммерческое название
 * @property string $address Фактический адрес
 * @property int $defaultPriceList Идентификатор прайса по умолчанию
 * @property string $image URL картинки
 * @property float $latitude Широта
 * @property float $longitude Долгота
 * @property string $locality Город
 * @property string $phone Первый телефон
 * @property string[] $phones Все номера телефонов
 * @property int[] $prices Идентификаторы прайсов
 * @property array $worktime Режим работы
 * @property array $halls Сырые данные по залам и схемам
 */
final readonly class SalesPoint
{
    public function __construct(
        public int $id,
        public ?string $name,
        public ?string $address,
        public ?int $defaultPriceList,
        public ?string $image,
        public ?float $latitude,
        public ?float $longitude,
        public ?string $locality,
        public ?string $phone,
        public ?array $phones,
        public array $prices,
        public WorkTime $worktime,
        public array $halls,
    ) {}

    /**
     * @param  array{
     *     id: int,
     *     name: string,
     *     address: string,
     *     defaultPriceList: int,
     *     image: string,
     *     latitude: string|float,
     *     longitude: string|float,
     *     locality: string,
     *     phone: string,
     *     phones: string[],
     *     prices: int[],
     *     worktime: array,
     *     halls: array
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: (string) $data['name'],
            address: (string) $data['address'],
            defaultPriceList: (int) $data['defaultPriceList'],
            image: (string) $data['image'],
            latitude: (float) ($data['latitude'] ?? 0.0),
            longitude: (float) ($data['longitude'] ?? 0.0),
            locality: (string) $data['locality'],
            phone: (string) $data['phone'],
            phones: $data['phones'] ?? [],
            prices: $data['prices'] ?? [],
            worktime: WorkTime::fromArray($data['worktime'] ?? []),
            halls: array_map(Hall::class.'::fromArray', $data['halls'] ?? []),
        );
    }
}
