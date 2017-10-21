<?php

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AutoLogComponent;
use Cake\Controller\Controller;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use Cake\TestSuite\TestCase;
use Cake\Core\Configure;
use Cake\Log\Log;

class AutoLogComponentTest extends TestCase
{

    public $component = null;
    public $controller = null;

    public function setUp()
    {
        parent::setUp();

        // Setup our component and fake test controller
        $request = new ServerRequest($this->getRequestData());
        $response = new Response();
        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();
        $registry = new ComponentRegistry($this->controller);
        $this->component = new AutoLogComponent($registry, [
            'masker' => 'aaa',
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->component, $this->controller);
    }

    public function testCollectInput()
    {
        $input = $this->getRequestData();
        $logData = $this->component->collectInput();
        $this->assertEquals($input['post'], $logData['data']);
        $this->assertEquals($input['query'], $logData['query']);
    }

    public function testMask_noMaskRule()
    {
        $input = $this->getRequestData();
        $logData = $this->component->collectInput();
        $maskedData = $this->component->mask($logData);
        $this->assertEquals($input['post'], $maskedData['data']);
        $this->assertEquals($input['query'], $maskedData['query']);
    }

    public function testMask_maskByMaskKeys()
    {
        $this->component->setConfig('mask_rules', [
            [
                'log_keys' => ['data'],
                'mask_keys' => ['/password/'],
            ]
        ], false);

        $logData = $this->component->collectInput();
        $maskedData = $this->component->mask($logData);

        $this->assertEquals('aaa', $maskedData['data']['password']);
        $this->assertEquals('aaa', $maskedData['data']['password_confirm']);
    }

    public function testMask_maskByLogKeys()
    {
        $this->setEnvVariables();
        $this->component->setConfig('mask_rules', [
            [
                'log_keys' => ['user_agent'],
            ]
        ], false);

        $logData = $this->component->collectInput();
        $maskedData = $this->component->mask($logData);

        $this->assertEquals('12345', $maskedData['data']['password']);
        $this->assertEquals('aaa', $maskedData['user_agent']);
    }

    public function testMask_ruleNotMatched()
    {
        $this->setEnvVariables();
        $input = $this->getRequestData();

        $this->component->setConfig('mask_rules', [
            [
                'log_keys' => ['user_agent_not_matched'],
            ]
        ], false);

        $logData = $this->component->collectInput();
        $maskedData = $this->component->mask($logData);

        $this->assertEquals($input['post'], $maskedData['data']);
        $this->assertEquals($input['query'], $maskedData['query']);
        $this->assertEquals($_SERVER['HTTP_USER_AGENT'], $maskedData['user_agent']);
        $this->assertEquals($_SERVER['SERVER_ADDR'], $maskedData['server_ip']);
    }

    public function testWriteToLog()
    {
        Log::reset();
        Log::setConfig([
            'access' => [
                'className' => 'Cake\Log\Engine\FileLog',
                'path' => LOGS,
                'file' => 'test_access',
                'levels' => ['info'],
                'url' => env('LOG_ACCESS_URL', null),
                'scopes' => ['access'],
            ],
        ]);

        $log_file = LOGS.'test_access.log';
        if (is_file($log_file)) {
            unlink($log_file);
        }

        $event = new Event('Controller.startup', $this->controller);
        $this->component->startup($event);

        // Check log file was created
        $this->assertTrue(is_file($log_file));

        // Check log file content
        $content = file_get_contents($log_file);
        $input = $input = $this->getRequestData();
        $expected = json_encode($input['query']);
        $expected = ltrim($expected, '{');
        $expected = rtrim($expected, '}');
        $this->assertContains($expected, $content);

        unlink($log_file);
    }

    protected function getRequestData()
    {
        return [
            'post' => [
                'username' => 'vanbach',
                'password' => '12345',
                'password_confirm' => '12345',
            ],
            'query' => ['foo' => 'bar'],
        ];
    }

    protected function setEnvVariables()
    {
        $_SERVER = array_merge($_SERVER, [
            'HTTP_USER_AGENT' => 'Chrome',
            'SERVER_ADDR' => '192.168.0.1',
        ]);
    }
}