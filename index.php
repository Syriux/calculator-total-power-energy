<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNB Calculation</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 60px;
        }
        thead, tbody {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Electricity Consumption Calculator</h1>
        <div class="box">
            <form action="" method="post">
                <div class="form-group">
                    <label for="voltage">Voltage (V):</label>
                    <input type="number" class="form-control" id="voltage" name="voltage" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="current">Current (A):</label>
                    <input type="number" class="form-control" id="current" name="current" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="rate">Current Rate (cents/kWh):</label>
                    <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Calculate</button>
            </form>
        </div>
        <?php

        //Fungsi 
        function calcRate($rate){
            $decimalRate = $rate/100;
            return $decimalRate;
        }
        function calcPower($volt, $current){
            $pow = $volt*$current;
            return $pow;
        }
        function calcEnergy($pow, $hour){
            $energy = ($pow*$hour)/1000;
            return $energy;
        }
        function calcTot($energy, $rate){
            $total = ($energy*$rate)/100;
            return $total;
        }

        if (isset($_POST['voltage'])&& isset($_POST['current']) && isset($_POST['rate'])) {
            $volt = $_POST['voltage'];
            $current = $_POST['current'];
            $rate = $_POST['rate'];
            $power = calcPower($volt,$current);
            $decimalRate = calcRate($rate);
            echo "<div class='mt-5'>";
            echo "<h2>Results:</h2>";
            echo "<p>Power: " .htmlspecialchars($power) . " Wh</p>";
            echo "<p>Rate: RM" . htmlspecialchars($decimalRate) . "</p>";
            echo "<h2>Detailed Hourly Table:</h2>";
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr></thead>";
            echo "<tbody>";
            for ($hour = 1; $hour <= 24; $hour++) {
                $energy = calcEnergy($power, $hour); // kWh
                $total = calcTot($energy,$rate); // RM
                echo "<tr><td>{$hour}</td><td>" . number_format($energy, 4) . "</td><td>" . number_format($total, 4) . "</td></tr>";
            }
            echo "</tbody></table>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>