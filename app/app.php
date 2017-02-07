<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Car.php';

    $app = new Silex\Application();

    $app->get('/', function() {
        return
        "<!DOCTYPE html>
        <html>
            <head>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' type='text/css'>
                <title>Find a Car</title>
            </head>
            <body>
                <div class='container'>
                    <h1>Find a Car!</h1>
                    <form action='/cars_matched_by_price'>
                        <div class='form-group'>
                            <label for='price'>Enter Maximum Price:</label>
                            <input id='price' name='price' class='form-control' type='number'>
                        </div>
                        <button type='submit' class='btn-success'>Submit</button>
                    </form>
                </div>
            </body>
        </html>
        ";
    });


    $app->get('/cars_matched_by_price', function() {
        $cars = array();

        array_push($cars,
            new Car("2014 Porsche 911", 114991, 7864)
        );

        array_push($cars,
            new Car("2011 Ford F450", 55995, 14241)
        );

        array_push($cars,
            new Car("2013 Lexus RX 350", 44700, 20000)
        );

        array_push($cars,
            new Car("2015 Mercedes Benz CLS550", 39900, 37979)
        );

        // Enable form to work without passed in price
        $max_price = 100000000;
        $my_key = "price";
        if (array_key_exists($my_key, $_GET)) {
          $max_price = $_GET[$my_key];
        }

        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->worthBuying($max_price)) {
                array_push($cars_matching_search, $car);
            }
        }

        $cars_matching_output = "";
        foreach ($cars_matching_search as $car) {
            $cars_matching_output .= "<li> " . $car->getMakeModel() . "</li>";
            $cars_matching_output .= "<ul>";
                $cars_matching_output .= "<li> $" . $car->getPrice() .  "</li>";
                $cars_matching_output .= "<li> Miles: " . $car->getMiles() . "</li>";
            $cars_matching_output .= "</ul>";
        }
        if (empty($cars_matching_search)) {
            $cars_matching_output .= "<li>No cars match criteria.</li>";
        }


        return
        "<!DOCTYPE html>
        <html>
            <head>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' type='text/css'>
                <title>Find a Car</title>
            </head>
            <body>
                <div class='container'>
                    <h1>Your Options!</h1>
                    <ul>
                        $cars_matching_output
                    </ul>
                </div>
            </body>
        </html>
        ";
    });



    return $app;
?>
