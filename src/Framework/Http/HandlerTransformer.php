<?php

namespace Framework\Http;

use Framework\Http\Request\Request;
use Framework\Repository\DataResource\DataFilePHP;
use Framework\Repository\RepositoryInterface;

class HandlerTransformer
{
    public function transform(array &$handler, Request $request): array
    {
        $existId = $request->getAttributes()['id'] ?? null;
        if ($existId === null) return $handler;

        $reflection = new \ReflectionClass($handler[0]);
        $method = $reflection->getMethod($handler[1]);

        foreach ($method->getParameters() as $index => $parameter) {
            if ($index === 0 || $parameter->getClass() === null) {
                continue;
            }
            $className = $parameter->getClass()->getShortName();
            $repositoryName = \sprintf('Application\\Repository\\%sRepository', $className);
            if (class_exists($repositoryName) === false) {
                throw new \Exception(\sprintf('There are not %s for class %s', $repositoryName, $className));
            }

            /** @var RepositoryInterface $repository */
            $repository = new $repositoryName(new DataFilePHP());
            $handler['arguments'][] = $repository->find($existId);
        }

        return $handler;
    }
}