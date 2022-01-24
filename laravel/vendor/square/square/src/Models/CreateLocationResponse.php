<?php

declare(strict_types=1);

namespace Square\Models;

use stdClass;

/**
 * Response object returned by the [CreateLocation]($e/Locations/CreateLocation) endpoint.
 */
class CreateLocationResponse implements \JsonSerializable
{
    /**
     * @var Error[]|null
     */
    private $errors;

    /**
     * @var Location|null
     */
    private $location;

    /**
     * Returns Errors.
     *
     * Information on [errors](https://developer.squareup.com/docs/build-basics/handling-errors)
     * encountered during the request.
     *
     * @return Error[]|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    /**
     * Sets Errors.
     *
     * Information on [errors](https://developer.squareup.com/docs/build-basics/handling-errors)
     * encountered during the request.
     *
     * @maps errors
     *
     * @param Error[]|null $errors
     */
    public function setErrors(?array $errors): void
    {
        $this->errors = $errors;
    }

    /**
     * Returns Location.
     *
     * Represents one of a business's [locations](https://developer.squareup.com/docs/locations-api).
     */
    public function getLocation(): ?Location
    {
        return $this->location;
    }

    /**
     * Sets Location.
     *
     * Represents one of a business's [locations](https://developer.squareup.com/docs/locations-api).
     *
     * @maps location
     */
    public function setLocation(?Location $location): void
    {
        $this->location = $location;
    }

    /**
     * Encode this object to JSON
     *
     * @param bool $asArrayWhenEmpty Whether to serialize this model as an array whenever no fields
     *        are set. (default: false)
     *
     * @return mixed
     */
    public function jsonSerialize(bool $asArrayWhenEmpty = false)
    {
        $json = [];
        if (isset($this->errors)) {
            $json['errors']   = $this->errors;
        }
        if (isset($this->location)) {
            $json['location'] = $this->location;
        }
        $json = array_filter($json, function ($val) {
            return $val !== null;
        });

        return (!$asArrayWhenEmpty && empty($json)) ? new stdClass() : $json;
    }
}
