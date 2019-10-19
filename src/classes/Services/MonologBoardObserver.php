<?php

namespace Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
/*
abstract class AbstractObserver 
{
    abstract function update(AbstractSubject $subject_in);
}
abstract class AbstractSubject 
{
    abstract function attach(AbstractObserver $observer_in);
    abstract function detach(AbstractObserver $observer_in);
    abstract function notify();
}
*/
class MonologBoardObserver extends AbstractObserver 
{
    public function __construct() 
    {
    }
    
    public function update(AbstractSubject $subject) 
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('./logs/monolog.txt', Logger::INFO));
        
        // Add info to the log
        $recursions = $subject->getRecursions();
        if($recursions > 0)
        {
            $log->info("Recursions: " . $recursions);
        }
    }
}