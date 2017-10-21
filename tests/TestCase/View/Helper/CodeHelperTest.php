<?php

namespace App\Test\TestCase\View\Helper;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use App\View\Helper\CodeHelper;

/**
 * Test case of src/Template/View/Helper/CodeHelper.php
 */
class CodeHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->Code = new CodeHelper(new View());
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->Code->clearCache();
    }

    public function testClearCache()
    {
        $this->assertEquals([], $this->Code->clearCache());
    }

    public function testGetList_fromDB()
    {
        $this->markTestIncomplete(
            'Not implement yet'
        );
    }

    public function testGetList_fromCache()
    {
        $this->markTestIncomplete(
            'Not implement yet'
        );
    }

    public function testGetKey_fromDB()
    {
        $this->markTestIncomplete(
            'Not implement yet'
        );
    }

    public function testGetKey_fromCache()
    {
        $this->markTestIncomplete(
            'Not implement yet'
        );
    }
}