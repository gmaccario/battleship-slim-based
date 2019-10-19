<?php

namespace Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MonologHistoryObserver extends AbstractObserver 
{
    public function __construct() 
    {
    }
    
    public function update(AbstractSubject $subject) 
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('./logs/monolog-history.txt', Logger::INFO));
        
        // Add info to the log
        $log->critical($subject->getIdGame() . ' ' . $subject->getPlayer());
    }
}