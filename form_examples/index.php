<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Form Examples</title>
</head>
<body>
    <div class="container">
    <!--
        action is what file you're sending form to
        # means same page/index.php
    -->
    <form method="POST" action="index.php">

   <label for="firstName"> Enter your name: </label><br>
       
   <input id="firstName" type="text" value="Enter first name" name="firstName"><br>
   <input type="submit">

    <textarea id="msg" cols="30" rows="10">
       
</textarea>
<br>

        <p>Color:</p>
        <label><input type="radio" name="color" value="blue" > Blue</label>
        <label><input type="radio" name="color" value="red" checked > Red</label>
        <label><input type="radio" name="color" value="yellow" > Yellow</label>

        <p>Size:</p>
        <label><input type="radio" name="size" value="small" > Small</label>
        <label><input type="radio" name="size" value="medium" checked > Medium</label>
        <label><input type="radio" name="size" value="large" > Large</label>
            

        <label for="color">Color:</label><br />
        <select id="color" name="color" multiple>
        <option value="blue">Blue</option>
        <option value="red" selected="selected">Red</option>
        <option value="yellow">Yellow</option>
        <option value="purple">Purple</option>
        <option value="green">Green</option>
        <option value="pink">Pink</option>
        
        <br>

        <input type="file" name="somefile" size="30" >

        <input type="submit" value="click me">
        <input type="reset" value="reset">
        <input type="button" value="generic">

    </form>
</select>
</div>
</body>
</html>