<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class SearchCars {
    /**
     * @Assert\LessThanOrEqual(propertyPath="maxYear", message="Doit être plus petit que l'année max")
     */
    private $minYear;
    /**
     * @Assert\GreaterThanOrEqual(propertyPath="minYear", message="Doit être plus grand que l'année min")
     */
    private $maxYear;

    /**
     * Get the value of minYear
     * 
     */ 
    public function getMinYear()
    {
        return $this->minYear;
    }

    /**
     * Set the value of minYear
     *
     * @return  self
     */ 
    public function setMinYear($minYear)
    {
        $this->minYear = $minYear;

        return $this;
    }

    /**
     * Get the value of maxYear
     */ 
    public function getMaxYear()
    {
        return $this->maxYear;
    }

    /**
     * Set the value of maxYear
     *
     * @return  self
     */ 
    public function setMaxYear($maxYear)
    {
        $this->maxYear = $maxYear;

        return $this;
    }
}
;