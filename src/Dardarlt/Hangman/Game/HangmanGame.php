<?php


namespace Dardarlt\Hangman\Game;

use Dardarlt\Hangman\Game\Exception\GameIsWonException;
use Dardarlt\Hangman\Game\Exception\NoTriesLeftException;
use Dardarlt\Hangman\Game\Exception\GuessFailedException;
use Dardarlt\Hangman\Game\Exception\LetterExistsException;
use Dardarlt\Hangman\Game\Word\Guessable;
use Dardarlt\Hangman\Game\Validation;
use Dardarlt\Hangman\Game\Word\StorableInterface;

class HangmanGame implements \JsonSerializable, StorableInterface
{
    /**
     * @var Guessable
     */
    protected $guessable;

    /**
     * @var int
     */
    protected $tries;

    /**
     * @var string
     */
    protected $status;

    const BUSY = 'busy';
    const SUCCESS = 'success';
    const FAIL = 'fail';
    const DEFAULT_TRIES = 11;
    const DEFAULT_STATUS = 'busy';

    public function __construct(Guessable $guessable)
    {
        $this->guessable = $guessable;
    }

    public function addLetter($letter)
    {
        if ($this->validate($letter)) {
            try {
                $this->checkTries();
                $this->guessable->guess($letter);
                $this->setStatus(self::BUSY);
                $this->tries--;
                return null;

            } catch (GameIsWonException $e) {
                $this->setStatus(self::SUCCESS);
                $this->tries--;
                return null;

            } catch (LetterExistsException $e) {
                $this->setStatus(self::BUSY);
                return null;

            } catch (GuessFailedException $e) {
                $this->setStatus(self::BUSY);
                $this->tries--;
                $this->checkGameIsEnded();

                return null;

            } catch (NoTriesLeftException $e) {
                $this->setTries(0);
                $this->setStatus(self::FAIL);
                return null;
            }
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        if (null === $this->status) {
            $this->status = self::DEFAULT_STATUS;
        }

        return $this->status;
    }

    /**
     * @param string $status
     * @return HangmanGame
     */
    public function setStatus($status)
    {

        $this->status = $status;
        return $this;
    }

    public function checkTries()
    {
        if ($this->getTries() < 1) {
            throw new NoTriesLeftException();
        }
    }

    /**
     * @return int
     */
    public function getTries()
    {
        if (null === $this->tries) {
            $this->tries = self::DEFAULT_TRIES;
        }
        return $this->tries;
    }

    /**
     * @param int $tries
     * @return HangmanGame
     */
    public function setTries($tries)
    {
        $this->tries = $tries;
        return $this;
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
                'word' => $this->getStateAsString(),
                'tries_left' => $this->getTries(),
                'status' => $this->getStatus()
            ];
    }

    protected function validate($letter)
    {
        return Validation::input($letter);
    }

    public function getStateAsString()
    {
        return implode('', $this->guessable->getState());
    }

    public function getWordAsString()
    {
        return implode('', $this->guessable->getWord());
    }

    protected function checkGameIsEnded()
    {
        try {
            $this->checkTries();
        } catch (NoTriesLeftException $e) {
            $this->setStatus(self::FAIL);
        }
    }
}
