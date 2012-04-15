<?php

    /* Configuration File Singleton */
    class Configuration {

          //static instance for singleton that 
          //holds a single instantinating of the class
          static private $instance = NULL;

          //flag that indicate if the file ini is affected or not
          private $updated = false;

          // array settings
          private $settings = array();

          //the name file configuration
          const path = 'config/config.ini';

          //the name of the file which calls configuration, default 'commands.php'
          private $whichFile = 'commands.php';

          //constructor of class that is private parce que we use singleton
          //prevents users from instantiating the class directly. 
          //they must use getInstance method
          private function __construct() {

                  //if file exists then grab the content
                  if(file_exists(self::path)) {

                         //turns ini file into array
                         $this->settings = parse_ini_file(self::path); 
                  }
          } 

          //static method returns the only instantiation of the class
          public static function getInstance() {

                 if(self::$instance == NULL) {

                        self::$instance = new Configuration();    
                 }

             return self::$instance;
          }

          //destructor of class
          public function __destruct() {

                 //if configuration hasn't changed, 
                 //no need to update it on disk (FILE INI)
                 if(!$this->updated) {

                      return false;
                 }

                 //prepare the file for write
                 $fp = fopen($this->_getPath(), "w");

                 //if handler is correct
                 if(!$fp) {

                    return false; 
                 } 

                 //iterate through settins and overwrite 
                 //INI File with the real version
                 foreach($this->settings as $id=>$name) {

                         fputs($fp, "$id = \"$name\"\n");
                 }

                 //close the file
                 fclose($fp);
          }

          //getter method for ini file
          public function get($id) {

                 if(isset($this->settings[$id])) {

                      return $this->settings[$id];
                 }
              return null;
          }

          //setter method for ini file
          public function set($id,$name) {
 
                 if(!isset($this->settings[$id]) || $this->settings[$id] != $name) {

                     $this->settings[$id] = $name;

                     $this->updated = true;

                    return array("status"=>"okay", "id"=>$id, "realname" => $name);
                 }

              return null; 
          }

          //delete from file ini
          public function del($id) {

                 if(isset($this->settings[$id])) {

                     unset($this->settings[$id]);

                     $this->updated = true;

                    return array("status"=>"okay", "id" => $id);
                 }

              return null; 
          }

          //Get Array of id=>realname
          public function getSettings() {

                 return $this->settings;
          } 

          /**
           * Update the settings Array that affects INI File configuration
           * @param $newArr Array - the new Array updated
           * @param $file Strin   - the name of the file which make the update, by default 'update.php'
           */
          public function setSettings($newArr, $file) {

                $this->whichFile = $file;

                $this->settings = $newArr;

                $this->updated = true;

              return $this->settings;
          } 

          //prepare the path
          public function _getPath() { 

                  $this->saveConfig = str_replace($this->whichFile, '', $_SERVER['SCRIPT_FILENAME']);

                  $this->saveConfig = $this->saveConfig . self::path; 

               return $this->saveConfig;  
          }

    }

?>