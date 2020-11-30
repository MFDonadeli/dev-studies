<?php

abstract class Entity implements \SplSubject
{
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class User extends Entity
{
    private $email;

    public function setEmail($email)
    {
        $this->email = $email;
        $this->notify();
    }
    public function getEmail()
    {
        return $this->email;
    }
}

class UserObserver implements \SplObserver
{
    private $changedUsers = [];
    private $emails = [];

    public function update(\SplSubject $subject)
    {
        $this->changedUsers[] = clone $subject;

        if (in_array($subject->getEmail(), $this->emails))
        {
            throw new \Exception("Duplicated value {$subject->getEmail()}");
        }
        $this->emails[] = $subject->getEmail();
    }

    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }
}

try {
    $observer = new UserObserver();

    $user = new User();
    $user->attach($observer);
    $user->setEmail('foo@bar.com');

    $user = new User();
    $user->attach($observer);
    $user->setEmail('foo2@bar.com');

/*
    $user = new User();
    $user->attach($observer);
    $user->setEmail('foo@bar.com');
*/
    var_dump($observer->getChangedUsers());
} catch (Exception $e) {
    echo $e->getMessage();
}