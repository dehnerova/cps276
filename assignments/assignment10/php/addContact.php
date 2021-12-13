<?php
/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init()
{
    global $elementsArr, $stickyForm;

    /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
    if (isset($_POST['submit'])) {

        /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
        $postArr = $stickyForm->validateForm($_POST, $elementsArr);

        /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
        if ($postArr['masterStatus']['status'] == "noerrors") {

            /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
            return addData($_POST);
        } else {
            /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
            return getForm("", $postArr);
        }
    }

    /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */ else {
        return getForm("", $elementsArr);
    }
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
    "masterStatus" => [
        "status" => "noerrors",
        "type" => "masterStatus"
    ],
    "name" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "Alex",
        "regex" => "name"
    ],
    "address" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Address cannot be blank and must be a standard address</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "123 East St.",
        "regex" => "address"
    ],
    "city" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>City cannot be blank and must be a standard city name</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "Ann Arbor",
        "regex" => "city"
    ],
    "state" => [
        "type" => "select",
        "options" => ["MI" => "Michigan", "OH" => "Ohio", "CA" => "California", "TN" => "Tennessee"],
        "selected" => "MI",
        "regex" => "name"
    ],
    "phone" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "999.999.9999",
        "regex" => "phone"
    ],
    "email" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a standard email address</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "youremail@domain.com",
        "regex" => "email"
    ], "dob" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Date of birth cannot be blank and must be a standard date</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "01/01/1990",
        "regex" => "dob"
    ],
    "contact" => [
        "type" => "checkbox",
        "action" => "notRequired",
        "status" => ["newsletter" => "", "email" => "", "text" => ""]
    ],
    "ageRange" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Must select an age</span>",
        "errorOutput" => "",
        "type" => "radio",
        "action" => "required",
        "value" => ["10-18" => "", "19-30" => "", "31-50" => "", "51+" => ""]
    ]
];


/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post)
{
    global $elementsArr;
    /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
    //print_r($_POST);
    require_once('classes/Pdo_methods.php');

    $pdo = new PdoMethods();

    $sql = "INSERT INTO contacts (name, address, city, state, phone, email, dob, contact, ageRange) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contact, :ageRange)";

    /* THIS TAKE THE ARRAY OF CHECK BOXES AND PUT THE VALUES INTO A STRING SEPERATED BY COMMAS  */
    if (isset($_POST['contact'])) {
        $contact = "";
        foreach ($post['contact'] as $v) {
            $contact .= $v . ",";
        }
        /* REMOVE THE LAST COMMA FROM THE CONTACTS */
        $contact = substr($contact, 0, -1);
    }

    if (isset($_POST['ageRange'])) {
        $ageRange = $_POST['ageRange'];
    } else {
        $ageRange = "";
    }

    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = [
        [':name', $_POST['name'], 'str'],
        [':address', $_POST['address'], 'str'],
        [':city', $_POST['city'], 'str'],
        [':state', $_POST['state'], 'str'],
        [':phone', $_POST['phone'], 'str'],
        [':email', $_POST['email'], 'str'],
        [':dob', $_POST['dob'], 'str'],
        [':contact', $contact, 'str'],
        [':ageRange', $_POST['ageRange'], 'str'],
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result == "error") {
        return getForm("<p>There was a problem processing your form</p>", $elementsArr);
    } else {
        return getForm("<p>Contact Information Added</p>", $elementsArr);
    }
}


/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr)
{

    global $stickyForm;
    $options = $stickyForm->createOptions($elementsArr['state']);

    /* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
    $form = <<<HTML
    <h1 style="text-align:center;">Add Contact</h1>
    <br>
          <div  style="padding:10px;">
          <form method="post" action="index.php?page=addContact">
          <div class="form-group">
          <label for="name">Name (letters only) {$elementsArr['name']['errorOutput']}</label>
          <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >

          </div>
          <div class="form-group">
              <label for="address">Address (just number and street) {$elementsArr['address']['errorOutput']}</label>
              <input type="text" class="form-control"  name="address" id="address"  value="{$elementsArr['address']['value']}" >
          </div>

          <div class="form-group">
              <label for="city">City {$elementsArr['city']['errorOutput']}</label>
              <input type="text" class="form-control"  name="city" id="city"  value="{$elementsArr['city']['value']}" >
          </div>

          <div class="form-group">
          <label for="state">State</label>
          <select class="form-control" id="state" name="state">
              $options
          </select>
          </div>

          <div class="form-group">
          <label for="phone">Phone (format 999.999.9999) {$elementsArr['phone']['errorOutput']}</label>
          <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
        </div>

        <div class="form-group">
            <label for="email">Email address{$elementsArr['email']['errorOutput']}</label>
            <input type="text" class="form-control" name="email" id="email" value="{$elementsArr['email']['value']}" >
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth {$elementsArr['dob']['errorOutput']}</label>
            <input type="text" class="form-control" name="dob" id="dob" value="{$elementsArr['dob']['value']}" >
        </div>

        <p>Please check all contact types you would like (optional):</p>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="contact[]" id="newsletter" value="newsletter" {$elementsArr['contact']['status']['newsletter']}>
        <label class="form-check-label" for="newsletter">Newsletter</label>
        </div>

        <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="contact[]" id="emailUpdates" value="email" {$elementsArr['contact']['status']['email']}>
        <label class="form-check-label" for="emailUpdates">Email Updates</label>
        </div>

        <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="contact[]" id="textUpdates" value="text" {$elementsArr['contact']['status']['text']}>
        <label class="form-check-label" for="textUpdates">Text Updates</label>
        </div>

        <p style="padding-top:15px;">Please select your age range (you must select one):{$elementsArr['ageRange']['errorOutput']}</p>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ageRange" id="10to18" value="10-18"  {$elementsArr['ageRange']['value']['10-18']}>
        <label class="form-check-label" for="10to18">10-18</label>
        </div>

        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ageRange" id="19to30" value="19-30"  {$elementsArr['ageRange']['value']['19-30']}>
        <label class="form-check-label" for="19to30">19-30</label>
        </div>

        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ageRange" id="31to50" value="31-50"  {$elementsArr['ageRange']['value']['31-50']}>
        <label class="form-check-label" for="31to50">31-50</label>
        </div>

        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ageRange" id="51plus" value="51+"  {$elementsArr['ageRange']['value']['51+']}>
        <label class="form-check-label" for="50plus">51+</label>
        </div>
    <br>
        <div>
        <br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
       <div style='padding-top:15px; text-align:center;' >
       <a href='index.php?page=welcome' class='btn btn-primary btn-sm active' role='button' aria-pressed='true'>Back to Home</a>
    </div>

    </form>
</div>

HTML;

    /* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */

    return [$acknowledgement, $form];
}
