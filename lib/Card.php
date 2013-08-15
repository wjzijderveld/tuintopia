<?php

/**
 * Class Card
 */
class Card 
{
    /** @var  string */
    private $type;

    /** @var array  */
    private $inputs;

    /** @var array  */
    private $outputs;

    /** @var  bool */
    private $providesSun;

    /** @var  bool */
    private $providesShadow;

    /** @var  bool */
    private $providesWind;

    /** @var  bool */
    private $provideWindCoverage;

    /** @var  bool */
    private $requiresSun;

    /** @var  bool */
    private $requiresShadow;

    /** @var  bool */
    private $requiresWind;

    /** @var  bool */
    private $requiresWindConverage;

    /** @var  Coord */
    private $coord;

    public function __construct()
    {
        $this->inputs = array();
        $this->outputs = array();
    }

    public function setCoord(Coord $coord)
    {
        $this->coord = $coord;
    }

    /**
     * @return \Coord
     */
    public function getCoord()
    {
        return $this->coord;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param array $inputs
     */
    public function setInputs($inputs)
    {
        sort($inputs);
        $this->inputs = $inputs;
    }

    /**
     * @return array
     */
    public function getInputs()
    {
        return $this->inputs;
    }

    /**
     * @param array $outputs
     */
    public function setOutputs($outputs)
    {
        sort($outputs);
        $this->outputs = $outputs;
    }

    /**
     * @return array
     */
    public function getOutputs()
    {
        return $this->outputs;
    }

    // @codeCoverageIgnoreStart
    // Methods not yet been used and implemented

    /**
     * @param boolean $provideShadow
     */
    public function setProvidesShadow($provideShadow)
    {
        $this->providesShadow = $provideShadow;
    }

    /**
     * @return boolean
     */
    public function getProvidesShadow()
    {
        return $this->providesShadow;
    }

    /**
     * @param boolean $provideWindCoverage
     */
    public function setProvideWindCoverage($provideWindCoverage)
    {
        $this->provideWindCoverage = $provideWindCoverage;
    }

    /**
     * @return boolean
     */
    public function getProvideWindCoverage()
    {
        return $this->provideWindCoverage;
    }

    /**
     * @param boolean $sun
     */
    public function setProvidesSun($sun)
    {
        $this->providesSun = $sun;
    }

    /**
     * @return boolean
     */
    public function getProvidesSun()
    {
        return $this->providesSun;
    }

    /**
     * @param boolean $wind
     */
    public function setProvidesWind($wind)
    {
        $this->providesWind = $wind;
    }

    /**
     * @return boolean
     */
    public function getProvidesWind()
    {
        return $this->providesWind;
    }

    /**
     * @param boolean $requiresShadow
     */
    public function setRequiresShadow($requiresShadow)
    {
        $this->requiresShadow = $requiresShadow;
    }

    /**
     * @return boolean
     */
    public function getRequiresShadow()
    {
        return $this->requiresShadow;
    }

    /**
     * @param boolean $requiresSun
     */
    public function setRequiresSun($requiresSun)
    {
        $this->requiresSun = $requiresSun;
    }

    /**
     * @return boolean
     */
    public function getRequiresSun()
    {
        return $this->requiresSun;
    }

    /**
     * @param boolean $requiresWind
     */
    public function setRequiresWind($requiresWind)
    {
        $this->requiresWind = $requiresWind;
    }

    /**
     * @return boolean
     */
    public function getRequiresWind()
    {
        return $this->requiresWind;
    }

    /**
     * @param boolean $requiresWindConverage
     */
    public function setRequiresWindConverage($requiresWindConverage)
    {
        $this->requiresWindConverage = $requiresWindConverage;
    }

    /**
     * @return boolean
     */
    public function getRequiresWindConverage()
    {
        return $this->requiresWindConverage;
    }

    // @codeCoverageIgnoreEnd

}