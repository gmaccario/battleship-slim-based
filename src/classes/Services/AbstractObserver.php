<?php
namespace Services;

abstract class AbstractObserver
{
    abstract function update(AbstractSubject $subject_in);
}