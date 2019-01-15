<?php

namespace TheCodingMachine\GraphQL\Controllers;

use TheCodingMachine\GraphQL\Controllers\Fixtures\TypeFoo;
use TheCodingMachine\GraphQL\Controllers\Types\MutableObjectType;

class TypeGeneratorTest extends AbstractQueryProviderTest
{
    public function testNameAndFields()
    {
        $typeGenerator = $this->getTypeGenerator();

        $type = $typeGenerator->mapAnnotatedObject(new TypeFoo(), $this->getTypeMapper());

        $this->assertSame('TestObject', $type->name);
        $type->freeze();
        $this->assertCount(1, $type->getFields());
    }

    public function testMapAnnotatedObjectException()
    {
        $typeGenerator = $this->getTypeGenerator();

        $this->expectException(MissingAnnotationException::class);
        $typeGenerator->mapAnnotatedObject(new \stdClass(), $this->getTypeMapper());
    }

    public function testextendAnnotatedObjectException()
    {
        $typeGenerator = $this->getTypeGenerator();

        $type = new MutableObjectType([
            'name' => 'foo',
            'fields' => []
        ]);

        $this->expectException(MissingAnnotationException::class);
        $typeGenerator->extendAnnotatedObject(new \stdClass(), $type, $this->getTypeMapper());
    }
}
