<?php

namespace App\Test\TestCase\Utility;

use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use App\Utility\Flysystem;

/**
 * Test case of src/Utility/Flysytem.php
 */
class FlysystemTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Configure::write('Flysystem', [
            'local' => [
                'adapter' => 'Local',
                'root' => ROOT.DS,
            ],
            'awsS3v3' => [
                'adapter' => 'AwsS3Adapter',
                'auth' => [
                    'credentials' => [
                        'key'    => '',
                        'secret' => '',
                    ],
                    'region' => 'ap-northeast-1',
                    'version' => 'latest',
                ],
                'bucket' => '',
                'prefix' => '', // Optional path prefix
            ],
            'uses' => 'local',
        ]);

        $this->Flysystem = Flysystem::class;
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->Flysystem::clearCache();
    }

    public function testClearCache()
    {
        $this->assertEquals([], $this->Flysystem::clearCache());
    }

    public function testGetDefaultUses()
    {
        $this->assertEquals('local', $this->Flysystem::getDefaultUses());
    }

    /**
     * @expectedException     \InvalidArgumentException
     */
    public function testGetDefaultUses_exeption()
    {
        Configure::write('Flysystem.uses', null);
        $this->Flysystem::getDefaultUses();
    }

    public function testGetAdapter_usesLocal_noCache()
    {
        $this->assertInstanceOf(
            \League\Flysystem\Adapter\Local::class, 
            $this->Flysystem::getAdapter()
        );
    }

    public function testGetAdapter_usesLocal_fromCache()
    {
        $this->Flysystem::getAdapter();
        Configure::write('Flysystem.local', []);
        $this->assertInstanceOf(
            \League\Flysystem\Adapter\Local::class, 
            $this->Flysystem::getAdapter()
        );
    }

    public function testGetAdapter_usesAwsS3Adapter()
    {
        $this->assertInstanceOf(
            \League\Flysystem\AwsS3v3\AwsS3Adapter::class, 
            $this->Flysystem::getAdapter('awsS3v3')
        );
    }

    public function testGetFilesystem_usesLocal_noCache()
    {
        $this->assertInstanceOf(
            \League\Flysystem\Filesystem::class, 
            $this->Flysystem::getFilesystem()
        );
    }

    public function testGetFilesystem_usesLocal_fromCache()
    {
        $this->Flysystem::getFilesystem();
        Configure::write('Flysystem.local', []);
        $this->assertInstanceOf(
            \League\Flysystem\Filesystem::class, 
            $this->Flysystem::getFilesystem()
        );
    }

    public function testGetFilesystem_usesAwsS3Adapter()
    {
        $this->assertInstanceOf(
            \League\Flysystem\Filesystem::class, 
            $this->Flysystem::getFilesystem('awsS3v3')
        );
    }
}