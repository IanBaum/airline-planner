<?php

    Class City
    {
        private $id;
        private $name;

        function __construct($city_id = null, $city_name)
        {
            $this->id = $city_id;
            $this->name = $city_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cities (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cities = $GLOBALS['DB']->query("SELECT * FROM cities;");
            $cities = [];
            foreach($returned_cities as $city)
            {
                $name = $city['name'];
                $id = $city['id'];
                $new_city = new City($id, $name);
                array_push($cities, $new_city);
            }
            return $cities;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cities;");
        }



    }

?>
