<?php
/**
 * HomeController
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Controllers;

use Slim\Container;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

if(!class_exists('HomeController'))
{
    /**
     * @name HomeController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class HomeController
    {
        private $container;
        
        public function __construct(Container $container) 
        {
            $this->container = $container;
        }
        
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args)
        {
            return $this->container->renderer->render($response, "index.php", array());
        }
    }
} 