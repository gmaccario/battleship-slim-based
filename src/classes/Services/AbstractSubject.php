<?php
namespace Services;

abstract class AbstractSubject
{
    abstract function attach(AbstractObserver $observer_in);
    abstract function detach(AbstractObserver $observer_in);
    abstract function notify();
}
