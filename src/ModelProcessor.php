<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model\ModelInterface;

class ModelProcessor
{    
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
     * @param  string   $json   The JSON representation of the object (array).
     * @param  string   $type   The decoding target type.
     * @return ModelInterface|array
     */
    public static function json_decode(string $json, string $type): ModelInterface|array
    {
        return ObjectSerializer::deserialize($json, $type);
    }
}
