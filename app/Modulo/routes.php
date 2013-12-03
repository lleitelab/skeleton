<?php
/* * ******************************************************** */
/* * ************ rotas de paginas do sistema  ************** */
/* * ******************************************************** */

$router->get('/', 'Modulo\Controller\Index');

/* * ******************************************************** */
/* * ******************* rotas técnicas ********************* */
/* * ******************************************************** */
$router->any('/**', function() {
            View::set('page', '404');
            View::render();
        });

$router->get('/phpinfo', function() {
            phpinfo();
            exit;
        });