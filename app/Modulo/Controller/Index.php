<?php

namespace Modulo\Controller;

use Service\View;
use Respect\Rest\Routable;

/**
 * Description of Index
 */
class Index implements Routable
{
    public function get() {
        View::setTemplatePath(realpath(__DIR__ . '/../resources/templates/'));
        $function = function() {
            
        };

        View::addRoutineToExecuteBeforeRender($function);

        View::set('pageHeader', 'modulo_header');
        View::set('pageFooter', 'modulo_footer');
        View::render();
    }
}