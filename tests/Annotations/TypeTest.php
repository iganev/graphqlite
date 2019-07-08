<?php

namespace TheCodingMachine\GraphQLite\Annotations;

use PHPUnit\Framework\TestCase;
use RuntimeException;

class TypeTest extends TestCase
{
    public function testException(): void
    {
        $type = new Type([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Empty class for @Type annotation. You MUST create the Type annotation object using the GraphQLite AnnotationReader');
        $type->getClass();
    }

    public function testExternal(): void
    {
        $type = new Type(['external'=>true]);
        $this->assertSame(false, $type->isSelfType());
    }
}
