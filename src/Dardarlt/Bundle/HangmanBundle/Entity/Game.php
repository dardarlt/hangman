<?php

namespace Dardarlt\Bundle\HangmanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=255)
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="tries", type="integer")
     */
    private $tries = 11;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    private $dateAdded;


    /**
     * Get id
     *
     * @return integer
     *
     * @codeCoverageIgnore
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     * @return Game
     *
     * @codeCoverageIgnore
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Game
     *
     * @codeCoverageIgnore
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set tries
     *
     * @param integer $tries
     * @return Game
     *
     * @codeCoverageIgnore
     */
    public function setTries($tries)
    {
        $this->tries = $tries;

        return $this;
    }

    /**
     * Get tries
     *
     * @return integer
     *
     * @codeCoverageIgnore
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Game
     *
     * @codeCoverageIgnore
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     *
     * @codeCoverageIgnore
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Game
     *
     * @codeCoverageIgnore
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     *  @ORM\PrePersist
     *
     * @codeCoverageIgnore
     */
    public function doStuffOnPrePersist()
    {
        $this->dateAdded = new \DateTime();
    }
}
