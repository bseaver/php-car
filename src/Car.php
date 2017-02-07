<?php
    class Car
    {
        private $make_model;
        private $price;
        private $formatted_price;
        private $miles;

        function __construct($year_make_model, $price_of_car, $miles_on_car)
        {
            $this->setMakeModel($year_make_model);
            $this->setPrice($price_of_car);
            $this->setMiles($miles_on_car);
        }

        function worthBuying($max_price)
        {
            return $this->price < $max_price;
        }

        function setMakeModel ($year_make_model) {
            $this->make_model = $year_make_model;
        }

        function getMakeModel()
        {
            return $this->make_model;
        }

        function setPrice($new_price)
        {
            $this->formatted_price = "(call for price)";
            $this->price = (float) $new_price;
            if ($this->price != 0) {
                $this->formatted_price = number_format($this->price, 2);
            }
        }

        function getPrice()
        {
            return $this->formatted_price;
        }


        function setMiles($miles_on_car) {
            $this->miles = (integer) $miles_on_car;
        }

        function getMiles()
        {
            return $this->miles;
        }
    }
?>
