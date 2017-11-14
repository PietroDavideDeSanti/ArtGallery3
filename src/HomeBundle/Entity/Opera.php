<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opera
 */
class Opera
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titolo;

    /**
     * @var string
     */
    private $tecnica;

    /**
     * @var int
     */
    private $dimensioni;

    /**
     * @var \DateTime
     */
    private $data;

    /**
     * @var int
     */
    private $idAutore;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return Opera
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;

        return $this;
    }

    /**
     * Get titolo
     *
     * @return string 
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Set tecnica
     *
     * @param string $tecnica
     * @return Opera
     */
    public function setTecnica($tecnica)
    {
        $this->tecnica = $tecnica;

        return $this;
    }

    /**
     * Get tecnica
     *
     * @return string 
     */
    public function getTecnica()
    {
        return $this->tecnica;
    }

    /**
     * Set dimensioni
     *
     * @param integer $dimensioni
     * @return Opera
     */
    public function setDimensioni($dimensioni)
    {
        $this->dimensioni = $dimensioni;

        return $this;
    }

    /**
     * Get dimensioni
     *
     * @return integer 
     */
    public function getDimensioni()
    {
        return $this->dimensioni;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Opera
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set idAutore
     *
     * @param integer $idAutore
     * @return Opera
     */
    public function setIdAutore($idAutore)
    {
        $this->idAutore = $idAutore;

        return $this;
    }

    /**
     * Get idAutore
     *
     * @return integer 
     */
    public function getIdAutore()
    {
        return $this->idAutore;
    }
}
