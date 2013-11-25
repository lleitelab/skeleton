<?php

namespace Service;

use \DateTime;

/**
 * 
 * @author leandro <leandro@leandroleite.info>
 */
class EasyDate
{
    protected $format = \DateTime::W3C;
    protected $dateTime;
    protected $direction;
    protected $sentence;

    private $daynames = "/^(sunday|monday|tuesday|wednesday|thursday|friday|saturday|sun|mon|tue|wed|thu|fri|sat)$/";
    private $period = "/^(day|days|week|weeks|month|months|year|years)$/";

    public function __construct($string)
    {
        $this->dateTime = new \DateTime($string);
    }

    public function get(EasyDate $easyDate)
    {
        return $easyDate->toString();
    }

    public function today()
    {
        $this->dateTime = new DateTime('now');
        return $this;
    }

    public function tomorrow()
    {
        $this->dateTime = new DateTime('tomorrow');
        return $this;
    }

    public function yesterday()
    {
        $this->dateTime = new DateTime('yesterday');
        return $this;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function follow($period)
    {
        $this->sentence = '+' . $period . ' ';
        return $this;
    }

    public function back($period)
    {
        $this->sentence = '-' . $period . ' ';
        return $this;
    }

    public function __call($name, $value)
    {
        $name = strtolower($name);
        if(preg_match($this->daynames, $name, $match)) {
            $this->sentence .= $match[1];
        }elseif(preg_match($this->period, $name, $match)) {
            $this->sentence .= $match[1];
        }else{
            echo 'opa';
        }

        $this->dateTime = new DateTime(date($this->format, strtotime($this->sentence . ' '. $this->toString()) ));

        return $this;
    }

    public function __toString()
    {
        return $this->dateTime->format($this->format);
    }

    public function toString()
    {
        return $this->__toString();
    }
}