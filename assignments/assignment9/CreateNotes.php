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
    <title>Create Note</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div id="wrapper" class="container">

        <h1>Add Note</h1>
        <div>
            <a href="DisplayNotes.php">Get Notes</a>
        </div>
        <div>
            <p>
                <?php echo $output; ?>
            </p>
        </div>
        <form method="POST" action="CreateNotes.php">
            <div>
                Date and Time
                <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
            </div>
            <br>
            <p>
                Note:
                <textarea style="height: 200px;" class="form-control" id="noteField" name="noteField" maxlength="100"></textarea>
            </p>

            <div>
                <button type="submit" class="btn btn-primary" id="submitAdd" name="submitAdd">Add Note</button>
            </div>
        </form>

    </div>
</body>

</html>