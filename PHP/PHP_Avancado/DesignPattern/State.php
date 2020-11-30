<?php

interface DoorState
{
    public function open();
    public function close();
    public function lock();
    public function unlock();
}

class IllegalStateTransitionException extends \LogicException
{
}

abstract class AbstractDoorState implements DoorState
{
    /**
     * @throws IllegalStateTransitionException
     */
    public function open()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function close()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function lock()
    {
        throw new IllegalStateTransitionException;
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function unlock()
    {
        throw new IllegalStateTransitionException;
    }
}

class ClosedDoorState extends AbstractDoorState
{
    /**
     * @return OpenDoorState
     */
    public function open()
    {
        return new OpenDoorState;
    }

    /**
     * @return LockedDoorState
     */
    public function lock()
    {
        return new LockedDoorState;
    }
}

class LockedDoorState extends AbstractDoorState
{
    /**
     * @return ClosedDoorState
     */
    public function unlock()
    {
        return new ClosedDoorState;
    }
}

class OpenDoorState extends AbstractDoorState
{
    /**
     * @return ClosedDoorState
     */
    public function close()
    {
        return new ClosedDoorState;
    }
}

class Door
{
    /**
     * @var DoorState
     */
    private $state;

    public function __construct(DoorState $state)
    {
        $this->setState($state);
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function open()
    {
        $this->setState($this->state->open());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function close()
    {
        $this->setState($this->state->close());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function lock()
    {
        $this->setState($this->state->lock());
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function unlock()
    {
        $this->setState($this->state->unlock());
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->state instanceof OpenDoorState;
    }

    /**
     * @return bool
     */
    public function isClosed()
    {
        return $this->state instanceof ClosedDoorState;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->state instanceof LockedDoorState;
    }

    private function setState(DoorState $state)
    {
        $this->state = $state;
    }
}

try {
    $door = new Door(new OpenDoorState);
    var_dump($door->isOpen());

    $door->close();
    var_dump($door->isClosed());

    $door->lock();
    var_dump($door->isLocked());

    $door->lock();
} catch (IllegalStateTransitionException $e) {
    echo 'error: ' . get_class($e);
}