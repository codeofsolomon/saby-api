<?php

namespace SabyApi\Domain\Dto\Requests;

use DateTimeInterface;
use JsonSerializable;

/**
 * Abstract base class for all request data transfer objects (DTOs).
 *
 * Provides utility methods for serializing request payloads,
 * automatically filtering out null values and recursively processing
 * nested objects and arrays. Useful for preparing clean and minimal
 * JSON payloads when interacting with APIs (e.g., iikoCloud).
 *
 * Extend this class in each specific request DTO to reuse
 * `prepareRequest()` logic and enable native JSON serialization
 * via `json_encode()`.
 */
abstract class BaseRequest implements JsonSerializable
{
    /** Готовый к отправке payload */
    public function toArray(): array
    {
        return self::clean(\get_object_vars($this));
    }

    /** Реализация JsonSerializable — просто вызываем toArray() */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /** Рекурсивная очистка и преобразование значений */
    private static function clean(array $data): array
    {
        $filtered = [];

        foreach ($data as $key => $value) {
            // 1. Отбрасываем null и пустые массивы
            if ($value === null || $value === []) {
                continue;
            }

            // 2. Объект даты → строка с миллисекундами
            if ($value instanceof DateTimeInterface) {
                $value = $value->format('Y-m-d H:i:s.v');
            }

            // 3. Вложенный DTO или другой JsonSerializable
            elseif (\is_object($value)) {
                $value = $value instanceof self
                    ? $value->toArray()
                    : ($value instanceof JsonSerializable
                        ? $value->jsonSerialize()
                        : self::clean(\get_object_vars($value)));
            }

            // 4. Массивы очищаем рекурсивно
            elseif (\is_array($value)) {
                $value = self::clean($value);
                if ($value === []) {
                    continue; // всё «обнулилось»
                }
            }

            $filtered[$key] = $value;
        }

        return $filtered;
    }
}
