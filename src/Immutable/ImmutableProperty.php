<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\PropertyTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;
use Calgamo\Collection\ArrayList;
use Calgamo\Collection\HashMap;

class ImmutableProperty extends ImmutableHashMap
{
    use PropertyTrait;

    /**
     * Set as string value
     *
     * @param string $key
     * @param string $value
     *
     * @throws ImmutableObjectException
     */
    public function setString(/** @noinspection PhpUnusedParameterInspection */string $key, string $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Set as list value
     *
     * @param string $key
     * @param array|ArrayList $value
     *
     * @throws ImmutableObjectException
     */
    public function setList(/** @noinspection PhpUnusedParameterInspection */string $key, $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Set as associative array value
     *
     * @param string $key
     * @param array|HashMap $value
     *
     * @throws ImmutableObjectException
     */
    public function setHashMap(/** @noinspection PhpUnusedParameterInspection */string $key, $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Set as int value
     *
     * @param string $key
     * @param int $value
     *
     * @throws ImmutableObjectException
     */
    public function setInteger(/** @noinspection PhpUnusedParameterInspection */string $key, int $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Set as float value
     *
     * @param string $key
     * @param float $value
     *
     * @throws ImmutableObjectException
     */
    public function setFloat(/** @noinspection PhpUnusedParameterInspection */string $key, float $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Set as bool value
     *
     * @param string $key
     * @param bool $value
     *
     * @throws ImmutableObjectException
     */
    public function setBoolean(/** @noinspection PhpUnusedParameterInspection */string $key, bool $value)
    {
        throw new ImmutableObjectException($this);
    }
}