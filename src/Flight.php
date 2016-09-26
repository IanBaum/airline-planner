<?php

    Class Flight
    {
        private $id;

        function __construct($flight_id = null)
        {
            $this->id = $flight_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_flights = $GLOBALS['DB']->query("SELECT * FROM flights;");
            $flights = [];
            foreach($returned_flights as $flights)
            {
                $id = $flights['id'];
                $new_flight = new Flight($id);
                array_push($flights, $new_flight);
            }
            return $flights;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM flights;");
        }
    }


?>
