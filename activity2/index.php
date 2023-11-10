<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="agecalculator.png" type="image/png">
    <title>Age Calculator</title>
    <style>
* {
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
    background-color: #235534;
    color: #FFFFFF;
}
/* Your existing styles here */

@media screen and (max-width: 576px) {
  /* CSS rules for mobile devices */

  h2 {
    font-size: 1.2rem; /* Adjust font size for better readability on small screens */
  }

  input {
    width: 80%; /* Make the input fields wider for better usability on small screens */
    margin-bottom: 10px; /* Add some space between input fields */
  }

  #calculate,
  #clear {
    width: 80%; /* Make the buttons wider for better usability on small screens */
    margin-top: 10px; /* Add some space between buttons */
  }
}
img {
    margin-top: 2%;
    width: 25%;
    height: 100%;
}

input {
    border-radius: 10px;
    border-color: #183A1D;
    width: 100px;
    height: 3vh;
    padding: 5px;
    font-size: large;
}

#calculate {
    width: 25%;
    height: 5%;
    padding: 17px 40px;
    border-radius: 50px;
    border: 1px solid #fff;
    color: #fff;
    background-color: hsl(261deg 80% 48%);
    box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-size: 15px;
    transition: all .5s ease;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
}

#calculate:hover {
    background-color: hsl(261deg 80% 48%);
    color: hsl(0, 0%, 100%);
    box-shadow: rgb(93 24 220) 0px 7px 29px 0px;
}

#calculate:active {
    background-color: hsl(261deg 80% 48%);
    color: hsl(0, 0%, 100%);
    box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
    transform: translateY(10px);
    transition: 100ms;
}

#result {
    font-size: x-large;
    color: #fff;
    letter-spacing: 1.5px;
}

#date,
#month,
#year {
    cursor: pointer;
}

#clear{
    width: 25%;
    height: 5%;
    padding: 17px 40px;
    border-radius: 50px;
    border: 1px solid #fff;
    box-shadow: 0px 0px 5px rgb(0, 0, 0, 0.5);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    font-size: 15px;
    transition: all .5s ease;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    margin-bottom: 20px; /* Add margin to separate from the result */
    background-color: red;
    color: #fff;
}


#clear:hover {
    background-color: transparent;
    color: hsl(0, 0%, 100%);
    border: 1px solid #fff;
}

#clear:active {
    background-color: red;
    color: hsl(0, 0%, 100%);
    box-shadow: rgb(93 24 220) 0px 0px 0px 0px;
    transform: translateY(10px);
    transition: 100ms;
}

    </style>
</head>
<body>
    <div>
        <img src="agecalculator.png" alt="calculator-img">
        <h2>All Must Be In Numbers Otherwise We Cannot Calculate</h2>
    </div>
    <br>
    <form method="post">
        <div class="form">
            Date of Birth:
            <input type="text" name="birth-date" required="required" pattern="\d{1,2}" placeholder="dd" title="Please enter a valid day (1-31)">&nbsp&nbsp - &nbsp
            <input type="text" name="birth-month" required="required" pattern="\d{1,2}" placeholder="mm" title="Please enter a valid month (1-12)">&nbsp&nbsp - &nbsp
            <input type="text" name="birth-year" required="required" pattern="\d{4}" placeholder="yyyy" title="Please enter a valid year (e.g., 1990)">&nbsp&nbsp &nbsp

            <br><br>
            Today's Date:
            <input type="text" id="date" disabled>&nbsp&nbsp - &nbsp
            <input type="text" id="month" disabled>&nbsp&nbsp - &nbsp
            <input type="text" id="year" disabled>&nbsp&nbsp &nbsp
            <br><br><br>
            <form method="post">
            <input type="submit" id="calculate" value="Calculate">
            <input type="button" id="clear" value="Clear Result"> <!-- Add Clear button -->
            <br><br><br>
            <div id="result">
            <?php
            $years = $months = $days = '';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $birthDate = $_POST["birth-date"];
                $birthMonth = $_POST["birth-month"];
                $birthYear = $_POST["birth-year"];

                // Validate input
                if (is_numeric($birthDate) && is_numeric($birthMonth) && is_numeric($birthYear)) {
                    $currentDate = date("Y-m-d");
                    $userInput = "$birthYear-$birthMonth-$birthDate";
                    if (checkdate($birthMonth, $birthDate, $birthYear) && strtotime($userInput) < strtotime($currentDate)) {
                        $diff = date_diff(date_create($userInput), date_create($currentDate));
                        $years = $diff->format('%y');
                        $months = $diff->format('%m');
                        $days = $diff->format('%d');
                    }
                }
            }
            if ($years !== '' && $months !== '' && $days !== '') {
                echo "<script>window.onload = function() {
                    document.getElementById('result').scrollIntoView({ behavior: 'smooth' });
                }</script>";
                echo "<div id='result'>Age: $years Years $months Months $days Days</div>";
            }
            ?>
            <br>
        </div>
    </form>

    <script>
        const date = document.getElementById("date");
        const month = document.getElementById("month");
        const year = document.getElementById("year");

        const currentDate = new Date();

        date.value = currentDate.getDate();
        month.value = currentDate.getMonth() + 1;
        year.value = currentDate.getFullYear();

        const clearButton = document.getElementById("clear");

        clearButton.addEventListener("click", function () {
            // Clear the displayed result
            const resultDiv = document.getElementById("result");
            resultDiv.innerHTML = "";
        });
    </script>
</body>
</html>
