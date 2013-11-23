<?php

namespace Modulo\Controller;

use Service\View;
use Respect\Rest\Routable;

/**
 * Description of Index
 */
class Index implements Routable {

    public function get() {
        View::set('pageHeader', 'modulo_header');
        View::set('pageFooter', 'modulo_footer');
        View::render();
    }

}