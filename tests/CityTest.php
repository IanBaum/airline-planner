<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes
    */

    require_once "src/City.php";

    $server = 'mysql:host=localhost:8889;dbname=airline_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CityTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            City::deleteAll();
        }
        function test_getName()
        {
            // Arrange
            $name = "Philadelphia";
            $id = null;
            $test_city = new City($id, $name);

            // Act
            $result = $test_city->getName();

            // Assert
            $this->assertEquals($name, $result);

        }

        function test_save()
        {
            //Arrange
            $name = "Philadelphia";
            $id = null;
            $test_city = new City($id, $name);
            $test_city->save();

            //Act
            $result = City::getAll();

            //Assert
            $this->assertEquals($test_city, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $name = "Philadelphia";
            $name2 = "Boston";
            $id = null;
            $test_city = new City($id, $name);
            $test_city->save();
            $test_city2 = new City($id, $name2);
            $test_city2->save();

            //Act
            $result = City::getAll();

            //Assert
            $this->assertEquals([$test_city, $test_city2], $result);
        }

        function test_deleteAll()
        {
            $name = "Philadelphia";
            $name2 = "Boston";
            $id = null;
            $test_city = new City($id, $name);
            $test_city->save();
            $test_city2 = new City($id, $name2);
            $test_city2->save();

            //Act
            City::deleteAll();
            $result = City::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }



?>
