<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ModelInterface;
use Compucie\Congressus\Model\StorageObject;

class ModelProcessor
{
    /**
     * Recursvily convert an object to an array. This method ensures that any object
     * contained in the given array are also converted to arrays. This useful because
     * simply casting the object to an array does not convert contained objects.
     * 
     * @param   object  $object     The object to convert.
     * @return  array
     */
    public static function convertObjectToArray(object $object): array
    {
        return json_decode(self::json_encode($object), associative: true);
    }

    /**
     * Typecast a model object.
     *
     * @param  ModelInterface   $model      The object to typecast.
     * @param  string           $type       The target type, e.g. `Event::class`.
     * @return ModelInterface               The typecast object.
     */
    public static function typecast(ModelInterface $model, string $type): ModelInterface
    {
        $data = ObjectSerializer::sanitizeForSerialization($model);
        return ObjectSerializer::deserialize($data, $type);
    }

    /**
     * JSON-encode a model object (array).
     *
     * @param  ModelInterface|array     $data   The object (array) to encode.
     * @return string                           The JSON-encoded object.
     */
    public static function json_encode(ModelInterface|array $data): string
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($data));
    }

    /**
     * JSON-decode a model object (array).
     *
     * @param  mixed    $json   The JSON representation of the object (array).
     * @param  string   $type   The decoding target type.
     * @return ModelInterface|array
     */
    public static function json_decode(mixed $json, string $type): ModelInterface|array
    {
        return ObjectSerializer::deserialize($json, $type);
    }

    /**
     * Return the first image object in the given media array.
     * @param   Model\StorageObject[]   $media  The media array to search in.
     * @return  Model\StorageObject
     * @throws  NoImageFoundException
     */
    public static function getFirstImage(array $media): StorageObject
    {
        foreach ($media as $entry) {
            if ($entry->getIsImage()) {
                return $entry;
            }
        }
        throw new NoImageFoundException;
    }
}

class NoImageFoundException extends \Exception
{
}
