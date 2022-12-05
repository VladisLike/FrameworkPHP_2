<?php

namespace Framework\Http\Response\Serializer;

class JsonSerializer
{
    private string $config;

    public function __construct(string $config)
    {
        $this->config = $config;
    }


    public function serialize(array $users, array $array): array
    {
        $jsonResult = [];
        $data = simplexml_load_file($this->config);
        $resultXML = $this->getXML($data, get_class($users[0]), $array['groups']);

        $result = [];
        foreach ($users as $user) {
            $names = [];
            $prop = [];
            foreach ($resultXML as $method) {
                $prop[] = $method;
                $handleMethod = 'get' . ucfirst($method);
                if (!in_array($handleMethod, get_class_methods($user))) {
                    $handleMethod = 'is' . ucfirst($method);
                }
                $names[] = $user->$handleMethod();
            }

            foreach ($names as $key => $name) {
                $result[$prop[$key]] = $name;
            }
            $jsonResult[] = json_encode($result);
        }

        return $jsonResult;
    }

    public function getXML($data, $objectStr, $groups): array
    {
        $resultXML = [];
        foreach ($data->children() as $child) {
            if ((string)$child['src'] === $objectStr) {
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

}