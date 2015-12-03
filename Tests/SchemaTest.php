<?php
/*
* This file is a part of graphql-youshido project.
*
* @author Alexandr Viniychuk <a@viniychuk.com>
* created: 12/1/15 2:20 AM
*/

namespace Youshido\Tests;

use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\TypeMap;
use Youshido\Tests\DataProvider\UserType;

class SchemaTest extends \PHPUnit_Framework_TestCase
{

    public function testObjectSchema()
    {
        $userType = new ObjectType(
            [
                'name'   => 'users',
                'fields' => [
                    'id' => ['type' => TypeMap::TYPE_INT]
                ]
            ]);

        $this->assertEquals("users", $userType->getName());
        $this->assertEquals("id", $userType->getConfig()->getField("id")->getName());
        $this->assertEquals(TypeMap::KIND_OBJECT, $userType->getKind());
        $this->assertInstanceOf('Youshido\GraphQL\Type\Scalar\IntType', $userType->getConfig()->getField("id")->getType());
    }

    public function testListSchema()
    {
        $listType = new ListType(
            [
                'name'      => 'users',
                'item'      => new UserType(),
                'args' => [
                    'count' => [
                        'type' => 'int'
                    ]
                ],
                'resolve'   => function ($object, $args = []) {

                }
            ]);

        $this->assertEquals("users", $listType->getName());
        $this->assertEquals(TypeMap::KIND_LIST, $listType->getKind());

    }

}
