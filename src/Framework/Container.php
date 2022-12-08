<?php

namespace Framework;

class Container
{
    private array $instances = [];

    public function get(string $id)
    {
        if ($this->has($id)) return $this->instances[$id];

        $reflection = new \ReflectionClass($id);

        if ($reflection->getConstructor() === null) {
            $this->set($id);
            return $this->instances[$id];
        }

        $idArguments = [];
        $parametersCount = \count($reflection->getConstructor()->getParameters());
        if ($parametersCount > 0) {
            foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                $args = $this->getXML($id);
                if ($parameter->getClass() !== null) {
                    $reflectionParam = new \ReflectionClass($parameterClassName = $parameter->getClass()->getName());
                    if (isset($args['arguments'])) {
                        $classArguments = \array_filter($args['arguments'], function ($arg) {
                            return $arg['type'] === 'class';
                        });
                        foreach ($classArguments as $classArg) {
                            $reflectionArg = new \ReflectionClass($classArg['value']);
                            if ($reflectionParam->isInterface()) {
                                if ($reflectionArg->implementsInterface($parameterClassName) === false) continue;
                            }

                            $idArguments[] = $this->get($classArg['value']);
                        }
                    } else {
                        $idArguments[] = $this->get($parameterClassName);
                    }
                } else {
                    $nonClassArguments = \array_filter($args['arguments'], function ($arg) {
                        return $arg['type'] !== 'class';
                    });
                    \array_walk($nonClassArguments, function ($nClassArg) use (&$idArguments) {
                        $idArguments[] = $nClassArg['value'];
                    });
                }
            }

            $this->instances[$id] = $reflection->newInstanceArgs($idArguments);
        }

        return $this->instances[$id];
    }

    public function set(string $id)
    {
        if (class_exists($id) === false) {
            throw new \Exception(\sprintf('No class with name - %s', $id));
        }

        $reflection = new \ReflectionClass($id);

        if ($reflection->getConstructor() === null) {
            $this->instances[$id] = $reflection->newInstance();
        }
    }

    public function has(string $id): bool
    {
        if (isset($this->instances[$id])) return true;
        return false;
    }

    private function getXML($class): array
    {
        $args = ['class' => $class];
        $data = simplexml_load_file('config/services.xml');
        foreach ($data->children() as $service) {
            if ($class === (string)$service['class']) {
                foreach ($service->arguments as $index => $argument) {
                    foreach ($argument as $item) {
                        $args[$index][] = [
                            'name' => (string)$item['name'],
                            'value' => (string)$item,
                            'type' => (string)$item['type']
                        ];
                    }
                }
            }
        }

        return $args;
    }

}