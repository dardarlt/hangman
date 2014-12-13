<?php


namespace Dardarlt\Hangman\Game;

use Dardarlt\Hangman\Game\Exception\GuessFailedException;
use Dardarlt\Hangman\Game\Exception\LetterExistsException;
use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Validation;

class Guessing implements \JsonSerializable
{
    protected $guessable;

    protected $tries;

    protected $status;

    const BUSY = 'busy';
    const SUCCESS = 'success';
    const FAIL = 'fail';

    public function __construct(Guessable $guessable)
    {
        $this->guessable = $guessable;
    }

    public function addLetter($letter)
    {
        if ($this->validate($letter)) {
            try {
                $this->guessable->guess($letter);
                $this->setSuccessfulTry();
                return null;

            } catch (LetterExistsException $e) {
                $this->setStatus(self::BUSY);
                return null;

            } catch (GuessFailedException $e) {
                //do nothing

            }
        }

        $this->setFailedTry();
        return null;

    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
                'word' => $this->guessable->getRepresentation(),
                'tries_left' => $this->getTries(),
                'status' => $this->getStatus()
            ];
    }

    protected function validate($letter)
    {
        return Validation::input($letter);
    }

    protected function setSuccessfulTry()
    {
        $this->setStatus(self::SUCCESS);
        $this->tries--;
    }

    protected function setFailedTry()
    {
        $this->setStatus(self::FAIL);
        $this->tries--;
    }
}
