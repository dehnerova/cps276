<?php

$output = "";

require_once 'Date_time.php';
$data = new Date_time();
$output = $data->checkingData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<style>
    table {
        /* creating a light-grey border around the table */
        border: 1px solid #efefef;
        border-collapse: separate;
        width: 100%;
    }

    th,
    td {
        /* making text aligned to the left */
        text-align: left;
        padding: 10px;
    }

    /* making every odd listing have a light-grey background */
    tr:nth-child(2n) {
        background-color: #efefef;
    }
</style>

<body>
    <div id="wrapper" class="container">
        <h1>Note Display</h1>
        <div>
            <a href="CreateNotes.php">Add a Note</a><br>
        </div>
        <form method="POST" action="DisplayNotes.php">
            <br>
            <div>
                Beginning Date
                <input type="date" class="form-control" id="begDate" name="begDate" placeholder="mm/dd/yyyy">
            </div>
            <br>
            <div>
                Ending Date
                <input type="date" class="form-control" id="endDate" name="endDate" placeholder="mm/dd/yyyy">
            </div>
            <br>
            <div>
                <button type="submit" class="btn btn-primary" id="submitDisplay" name="submitDisplay">Get Notes</button>
            </div>

        </form>
        <p>
        <table>
            <?php echo $output; ?>
        </table>
        </p>
    </div>
</body>

</html>