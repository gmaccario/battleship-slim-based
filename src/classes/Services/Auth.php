<?php
/**
 * Auth
 *
 * @description
 * @package Battleship
 * @author Giuseppe Maccario <g_maccario@hotmail.com>
 * @version 1.0
 * @license GPLv3 <http://www.gnu.org/licenses/gpl.txt>
 */

namespace Services;

use PropelModels\GameQuery;

if(!class_exists('Auth'))
{
    class Auth{
        
        protected $dev_id = '';
        protected $app_id = '';
        protected $token = '';
        
        /**
         * @name __construct
         * @description
         *
         * @return void
         */
        public function __construct() 
        {
            
        }
        
        /**
         * @name __construct
         * @description
         * 
         * @param string $dev_id
         *
         * @return void
         */
        public function setDevId(string $dev_id) : void
        {
            
            $this->dev_id = $dev_id;
        }
        
        /**
         * @name setAppId
         * @description
         * 
         * @param string $app_id
         *
         * @return void
         */
        public function setAppId(string $app_id)  : void
        {
            
            $this->app_id = $app_id;
        }
        
        /**
         * @name setToken
         * @description
         * 
         * @param string $token
         *
         * @return void
         */
        public function setToken(string $token)  : void
        {
            $this->token = $token;
        }
        
        /**
         * @name getToken
         * @description
         *
         * @return string
         */
        public function getToken() : string 
        {
            return $this->token;
        }
    
        /**
         * @name isValidConfig
         * @description Validation app and dev ids
         * 
         * @param string $dev_id
         * @param string $app_id
         *
         * @return bool
         */
        public function isValidConfig(string $dev_id, string $app_id) : bool
        {
            
            /**
             * @note Check on db in real case
             */
            if(empty($this->dev_id) || empty($this->app_id)){
                return false;
            }
            if($this->dev_id != $dev_id || $this->app_id != $app_id){
                return false;
            }
            
            return true;
        }
        
        /**
         * @name isActiveToken
         *
         * @return bool
         */
        public function isActiveToken() : bool
        {
            /*
             * Check if Game exists for the token
             */
            if(!$gameQuery)
            {
                return false;
            }
            
            return true;
        }
        
        /**
         * @name generateSignature
         * @description Generates the signature
         *
         * @return string
         */
        public function generateSignature() : string
        {
            $this->token = bin2hex(random_bytes(32));

            return $this->token;
        }
    }
}