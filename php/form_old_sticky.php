<?php
/*INCLUDE FILES*/
require_once('classes/Validation.php');

/*ARRAY THAT WILL STORE THE ERROR MESSAGES*/
$errorArray = array();

/* THE ISSET DETERMINES IF A VARIABLE IS SET AND IS NOT NULL IN THE CODE BELOW I AM CHECKING THAT THE SUBMIT BUTTON HAS BEEN CLICKED (SENT)*/
if (isset($_POST['submit'])) {
    validate();
}


function validate()
{
    //echo "<pre>";
    //print_r($_POST);

    /*INITIATE OBJECT OF THE VALIDATION CLASS*/
    $Validation = new Validation();

    /*ANY VARIABLE CREATED OUTSIDE THE FUNCTION MUST BE GLOBAL TO BE USED INSIDE A FUNCTION.
    OR PASSED VIA THE PARAMETER. ALSO ANY VARIABLES CREATED INSIDE THE FUNCTION THAT ARE
    SET AS GLOBAL CAN BE USED OUTSIDE THE FUNCTION.*/
    global $errorArray, $chkbox1, $chkbox2, $radio1, $radio2;

    /*THIS CHECKS THE ENTRY AND IF THERE IS AN ERROR PUTS THE MESSAGE INTO THE ERRORARRAY
    SINCE WE ARE JUST CHECKING FOR BLANKS WE DO NOT NEED A SECOND CLASS. BUT THIS CLASS
    CAN BE EXPANDED TO CHECK FOR FORMATTING USING REGULAR EXPRESSIONS.  SO I AM USING IT
    HERE.*/
    $errorArray[0] = $Validation->checkForBlanks($_POST['fname']);
    $errorArray[1] = $Validation->checkForBlanks($_POST['lname']);

    /*THIS CHECKS THE CHECKBOXES, IF A CHECKBOX HAS BEEN CHECKED, THEN IT WILL DISPLAY AS CHECKED. */
    if (isset($_POST['chkbox'])) {
        foreach ($_POST['chkbox'] as $v) {

            /*CHKBOX1 AND CHECKBOX2 ARE THE VALUES ASSIGNED TO THE CHECKBOX.*/
            switch ($v) {
                case "chkbox1":
                    $chkbox1 = "checked=checked";
                    break;
                case "chkbox2":
                    $chkbox2 = "checked=checked";
                    break;
            }
        }
    }

    /*THIS CHECKS THE RADIO BUTTONS FOR A SELECTION, IF A RADIO BUTTON WAS SELECTED SHOWS IT ON THE FORM.*/
    if (isset($_POST['radio'])) {
        switch ($_POST['radio']) {
            case "radio1":
                $radio1 = "checked=checked";
                break;
            case "radio2":
                $radio2 = "checked=checked";
                break;
        }
    }


    /*THIS DOES A FINAL CHECK FOR ERRORS IF NONE ARE FOUND IT SAYS "NO ERRORS FOUND" IN AN ACTUAL APPLICATION IT WOULD 
	DO SOMETHING WITH THE INFORMATION.*/
    if (!$Validation->checkErrors()) {
        echo "No Errors Found";
    }
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
    <title>Validating a Form with PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="css/main.css" />
</head>

<body>

    <!--PHP WAS INSERTED INTO THIS HTML FORM TO MAKE THE ENTRIES STICKY.  THIS MEANS THAT IF AN ERROR WAS MADE IT WILL DISPLAY THE ENTRIES IN
THE FORM ELEMENTS AND SHOW ANY ERROR MESSAGES.-->
    <form method="post" action="form_old_sticky.php">
        <div><label class="block" for="fname">First Name<?php if (isset($errorArray[0])) {
                                                            echo "<span class='error'>{$errorArray[0]}</span>";
                                                        } ?></label>
            <input type="text" id="fname" name="fname" value="<?php if (isset($_POST['fname'])) {
                                                                    echo $_POST['fname'];
                                                                } ?>">
        </div>

        <div><label class="block" for="lname">Last Name<?php if (isset($errorArray[1])) {
                                                            echo "<span class='error'>{$errorArray[1]}</span>";
                                                        } ?></label>
            <input type="text" id="lname" name="lname" value="<?php if (isset($_POST['lname'])) {
                                                                    echo $_POST['lname'];
                                                                } ?>">
        </div>

        <div><input type="checkbox" id="checkbox1" name="chkbox[]" value="chkbox1" tabindex="30" <?php if (isset($chkbox1)) {
                                                                                                        echo $chkbox1;
                                                                                                    } ?>><label for="checkbox1">Check Box One</label>

            <input type="checkbox" id="checkbox2" name="chkbox[]" value="chkbox2" <?php if (isset($chkbox2)) {
                                                                                        echo $chkbox2;
                                                                                    } ?>><label for="checkbox2">Check Box Two</label>
        </div>

        <div><input type="radio" id="radio1" name="radio" value="radio1" <?php if (isset($radio1)) {
                                                                                echo $radio1;
                                                                            } ?>><label for="radio1">Radio Button One</label>
            <input type="radio" id="radio2" name="radio" value="radio2" <?php if (isset($radio2)) {
                                                                            echo $radio2;
                                                                        } ?>><label for="radio2">Radio Button Two</label>
        </div>

        <div><input type="submit" name="submit" value="Submit"></div>
    </form>
</body>

</html>