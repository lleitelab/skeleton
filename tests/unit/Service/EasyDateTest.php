<?php

use Service\EasyDate;
use \DateTime;


class EasyDateTest extends PHPUnit_Framework_TestCase
{
    private $easyDate;
    private $defaultFormat = DateTime::W3C; 
    public function setUp()
    {
        $this->easyDate = new EasyDate('now');
    }

    public function tearDown()
    {

    }

    public function testIfReturnToday()
    {
        $today = new DateTime('now');
        $this->easyDate->setFormat($this->defaultFormat);
        $this->assertEquals($today->format($this->defaultFormat), $this->easyDate->today()->toString());
    }

    public function testIfShowTomorrow()
    {
        $dateToString = date($this->defaultFormat, strtotime('tomorrow'));
        $this->assertEquals($dateToString, $this->easyDate->tomorrow()->toString());
    }

    public function testIfFollowTwoDaysAhead()
    {
        $dateToString = date($this->defaultFormat, strtotime('+2 days now'));
        $this->assertEquals($dateToString, $this->easyDate->follow(2)->days()->toString());
    }

    public function testIfFollowTwoWeeksAhead()
    {
        $dateToString = date($this->defaultFormat, strtotime('+2 weeks now'));
        $this->assertEquals($dateToString, $this->easyDate->follow(2)->weeks()->toString());
    }

    public function testIfFollowTwoSpecificDaysAhead()
    {
        $dateToString = date($this->defaultFormat, strtotime('+2 monday ' . (new DateTime('now'))->format($this->defaultFormat) ));
        $this->assertEquals($dateToString, $this->easyDate->today()->follow(2)->monday()->toString());
        $this->assertEquals($dateToString, $this->easyDate->today()->follow(2)->mon()->toString());
        
        $dateToString = date($this->defaultFormat, strtotime('+2 friday ' . (new DateTime('now'))->format($this->defaultFormat) ));
        $this->assertEquals($dateToString, $this->easyDate->today()->follow(2)->friday()->toString());
        $this->assertEquals($dateToString, $this->easyDate->today()->follow(2)->fri()->toString());
    }

    public function testIfShowYesterday()
    {
        $dateToString = date($this->defaultFormat, strtotime('yesterday'));
        $this->assertEquals($dateToString, $this->easyDate->yesterday()->toString());
    }

    public function testIfBackTwoDays()
    {
        $dateToString = date($this->defaultFormat, strtotime('-2 days'));
        $this->assertEquals($dateToString, $this->easyDate->back(2)->days()->toString());
    }

    public function testIfBackTwoWeeks()
    {
        $dateToString = date($this->defaultFormat, strtotime('-2 weeks'));
        $this->assertEquals($dateToString, $this->easyDate->back(2)->weeks()->toString());
    }

}