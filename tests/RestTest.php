<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Services\Rest;
use Services\RestRetentionCurve;
use Services\Auth;

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

final class RestTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function test401Unauthorized(): void
    {
        /*
         * @note Run in separate mode allows me to test an API result without Headers error already sent message.
         * */
        
        $endpoint = '/private-api/get-retention-curve-weekly-cohorts'; 
        
        $auth = new Auth();
        $auth->setToken('');
        
        $rest = new Rest($auth, $endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"message-error":"401Unauthorized\/private-api\/get-retention-curve-weekly-cohorts"}', str_replace(' ', '', $resultSet));
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testRestSuperClassWrongEndpoint(): void
    {
        /*
         * @note Run in separate mode allows me to test an API result without Headers error already sent message.
         * */
        
        $endpoint = '/private-api/another-endpoint/whatever';
        
        $auth = new Auth();
        $auth->setToken('eyJ0eXAiOiJQVFMiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiUU4zTUxQSk9KVkdQMlpOT0FTS0tHQUdIRUNSSFVETklSSzJDSTFGVVVMS1NJS04xIn0.QYRr8HzguAsK7XDOobd9i6_4aPluKYKMWZMX-GjyeKQ');
        
        $rest = new Rest($auth, $endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"message-error":"NoEndpoint\/private-api\/another-endpoint\/whatever"}', str_replace(' ', '', $resultSet));
    }
    
    /**
     * @runInSeparateProcess
     */
    public function testRetentionCurveClass(): void
    {
        $endpoint = '/private-api/get-retention-curve-weekly-cohorts';
        
        $auth = new Auth();
        $auth->setToken('eyJ0eXAiOiJQVFMiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiUU4zTUxQSk9KVkdQMlpOT0FTS0tHQUdIRUNSSFVETklSSzJDSTFGVVVMS1NJS04xIn0.QYRr8HzguAsK7XDOobd9i6_4aPluKYKMWZMX-GjyeKQ');

        $rest = new RestRetentionCurve($auth, $endpoint);
        
        $resultSet = $rest->processAPI(array('foo' => true, 'pluto' => 'far'));
        
        $this->assertEquals('{"weeks":[]}', str_replace(' ', '', $resultSet));
    }
}