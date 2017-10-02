<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CasterTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CasterTagsTable Test Case
 */
class CasterTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CasterTagsTable
     */
    public $CasterTagsTable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CasterTags') ? [] : ['className' => CasterTagsTable::class];
        $this->CasterTagsTable = TableRegistry::get('CasterTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CasterTagsTable);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
