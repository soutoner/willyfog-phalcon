<?php

namespace Helpers\Strings;

use App\Helpers\Strings\NameHelper;

class StringHelperTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testNamespaceToClassNameWithClassName()
    {
        $full_class_name = 'ClassName';
        $class_name = NameHelper::namespaceToClassName($full_class_name);
        $expected = 'ClassName';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testNamespaceToClassNameWithClassNameAndRemove()
    {
        $full_class_name = 'ClassName';
        $class_name = NameHelper::namespaceToClassName($full_class_name, 'Name');
        $expected = 'Class';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testNamespaceToClassNameWithFullNamespace()
    {
        $full_class_name = 'Class\With\NameSpace\ClassName';
        $class_name = NameHelper::namespaceToClassName($full_class_name);
        $expected = 'ClassName';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testNamespaceToClassNameWithFullNamespaceAndRemove()
    {
        $full_class_name = 'Class\With\NameSpace\ClassName';
        $class_name = NameHelper::namespaceToClassName($full_class_name, 'Name');
        $expected = 'Class';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testTableNameFromClassName()
    {
        $full_class_name = 'ClassName';
        $class_name = NameHelper::tableNameFromClassName($full_class_name);
        $expected = 'classname';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testTableNameFromClassNameWRemove()
    {
        $full_class_name = 'ClassName';
        $class_name = NameHelper::tableNameFromClassName($full_class_name, 'Class');
        $expected = 'name';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testTableNameFromNamespace()
    {
        $full_class_name = 'Class\With\NameSpace\ClassName';
        $class_name = NameHelper::tableNameFromClassName($full_class_name);
        $expected = 'classname';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testTableNameFromNamespaceWRemove()
    {
        $full_class_name = 'Class\With\NameSpace\ClassName';
        $class_name = NameHelper::tableNameFromClassName($full_class_name, 'Class');
        $expected = 'name';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testSeederFromModel()
    {
        $seeder = 'App\Db\Seeds\Models\ModelSeeder';
        $class_name = NameHelper::seederToModel($seeder);
        $expected = 'App\Models\Model';
        $this->tester->assertEquals($expected, $class_name);
    }

    public function testSeederFromModelRelationship()
    {
        $seeder = 'App\Db\Seeds\Models\Relationship\ModelSeeder';
        $class_name = NameHelper::seederToModel($seeder);
        $expected = 'App\Models\Relationship\Model';
        $this->tester->assertEquals($expected, $class_name);
    }
}
