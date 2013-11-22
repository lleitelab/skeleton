<?php

use Service\View;

class ViewTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        
    }

    public function tearDown()
    {

    }

    public function testIfTemplatePathIsSetted()
    {
        $templatePath = '/the/template/path';
        View::setTemplatePath($templatePath);
        $this->assertEquals($templatePath.DIRECTORY_SEPARATOR.'index.php', View::getFullPath());
    }

    public function testIfVariablesAreSetted()
    {
        $variable = 'some value';
        View::set('var',$variable);
        $this->assertTrue(View::exists('var'));
        $this->assertEquals($variable, View::get('var'));
    }

    public function testIfBaseViewAreSetted()
    {
        $templatePath = '/the/template/path';
        View::setTemplatePath($templatePath);
        View::setBaseView('moduleIndex');

        $file = View::getFullPath();
        $expectedFile = $templatePath . DIRECTORY_SEPARATOR . 'moduleIndex.php';
        $this->assertEquals($expectedFile, $file);
    }
    
    public function testIfIsPossibleToChangeExtension()
    {
        $templatePath = '/the/template/path';
        View::setTemplatePath($templatePath);
        View::setBaseView('moduleIndex');
        View::setExtension('.ext');
        
        $file = View::getFullPath();
        $expectedFile = $templatePath . DIRECTORY_SEPARATOR . 'moduleIndex.ext';
        $this->assertEquals($expectedFile, $file);
    }

    /**
     * @expectedException \Exception
     * */
    public function testIfVerifyUnexistentFile()
    {
        $templatePath = '/the/template/path';
        View::setTemplatePath($templatePath);
        View::render();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Just Test
     * */
    public function testIfRoutinneIsOk()
    {
        $func = function(){ throw new \Exception("Just Test", 1);};
        View::addRoutineToExecuteBeforeRender($func);
        View::render();
    }
}