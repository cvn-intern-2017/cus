<?php
    if ( ! defined('PATH_MODEL')) die ('Bad requested!');
    include_once PATH_MODEL . '\Base_Model.php';
    class Access_Model extends Base_Model
    {
        function __construct()
        {
            parent::__construct();
        }

        function getURlbyKey($key)
        {
            $this->setQuery("SELECT original_link FROM URL where key_link = ?");
            $results = $this->loadRow(array($key));
            if($results){
                return $results->original_link;
            }
            else
            {
                // page 404
            }


        }
    }
?>
