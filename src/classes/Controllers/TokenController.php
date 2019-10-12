<?php
/**
 * TokenController
 *
 *
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Controllers;

use \Firebase\JWT\JWT;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

if(!class_exists('TokenController'))
{
    /**
     * @name TokenController
     * @description 
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    class TokenController
    {        
        /**
         * @name __invoke
         *
         * @author G.Maccario <g_maccario@hotmail.com>
         * @return
         */
        public function __invoke(Request $request, Response $response, array $args)
        {
            $now = new \DateTime();
            $future = new \DateTime("now +2 hours");
            $jti = bin2hex(random_bytes(32));
            
            $secret = "sup3rs3cr37ke1";
            
            $payload = [
                "jti" => $jti,
                "iat" => $now->getTimeStamp(),
                "nbf" => $future->getTimeStamp()
            ];
            
            // Create actual token
            $token = JWT::encode($payload, $secret, "HS256");
            
            // 200 OK
            return $response->withJson(array('token' => $token), 200);
        }
    }
} 