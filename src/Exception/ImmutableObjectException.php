<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Collection\Immutable\ImmutableCollection;
use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

class ImmutableObjectException extends CalgamoException implements CollectionExceptionInterface, RuntimeExceptionInterface
{
    /**
     * ImmutableObjectException constructor.
     *
     * @param ImmutableCollection $collection
     * @param \Exception $prev
     */
    public function __construct( ImmutableCollection $collection, $prev = NULL )
    {
        parent::__construct( 'Collection is immutable: ' . get_class($collection) . '@' . spl_object_hash($collection), $prev );
    }
}


