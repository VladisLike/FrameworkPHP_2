<?php

namespace Framework\Http\Response\Serializer;

use Framework\Common\Model;

class JsonSerializer
{
    private string $config;

    public function __construct(string $config)
    {
        $this->config = $config;
    }

    public function serialize(array $entity, array $array): array
    {
        $jsonResult = [];
        $data = simplexml_load_file($this->config);

        $resultXML = $this->getXML($data, $this->getClassName($entity), $array['groups']);

        $result = [];
        foreach ($entity as $item) {
            $names = [];
            $props = [];
            foreach ($resultXML as $property) {
                $props[] = $property;
                $handleMethod = 'get' . ucfirst($property);
                if (!in_array($handleMethod, get_class_methods($item))) {
                    $handleMethod = 'is' . ucfirst($property);
                }
                $res = $item->$handleMethod();
                if (is_array($res)) {
                    $res = $this->serialize($res, $array);
                }
                $names[] = $res;
            }

            foreach ($names as $key => $name) {
                $result[$props[$key]] = $name;
            }
            $jsonResult[] = $result;
        }


        return $jsonResult;
    }

    public function getXML($data, $classStr, $groups): array
    {
        $resultXML = [];
        foreach ($data->children() as $child) {
            if ((string)$child['src'] === $classStr) {
                foreach ($child->field as $item) {
                    $attr = (string)$item['group'];
                    if (in_array($attr, $groups)) {
                        $resultXML[] = (string)$item;
                    }
                }
            }
        }

        return $resultXML;
    }

    private function getClassName(array $entity): string
    {
        $className = "";

        if (isset($entity[0]) && is_object($entity[0])) {
            $className = get_class($entity[0]);
        }

        return $className;
    }

}