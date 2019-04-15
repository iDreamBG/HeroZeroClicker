<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Baron
 *
 * @ORM\Table(name="baron")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BaronRepository")
 */
class Baron
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var double
     *
     * @ORM\Column(name="booster", type="decimal", precision=10, scale=2)
     */
    private $booster;


//    /**
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    private $user;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Baron
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set booster
     *
     * @param double $booster
     *
     * @return Baron
     */
    public function setBooster($booster)
    {
        $this->booster = $booster;

        return $this;
    }

    /**
     * Get booster
     *
     * @return double
     */
    public function getBooster()
    {
        return $this->booster;
    }
}

