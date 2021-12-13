<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      $res = addData($_POST);

      if($res=="error"){
        return getform("<h1 style='text-align:center;'>Login</h1><p>There was an error returning your request</p>",$elementsArr);
      }
          
      else if(count($res)>0){
            session_start();
            $_SESSION['access']="accessgranted";
            $_SESSION['status']=$res[0]['status'];
            $_SESSION['name']=$res[0]['name'];
            header('location: index.php?page=welcome');

          }
          else {
            return getform("<h1 style='text-align:center;' >Login</h1><p>Credentials not found</p>",$elementsArr);       
          }
          
        }
    else{
         return getform("<h1 style='text-align:center;' >login</h1>",$postArr);
        }
  }
  
  else{
         return getform("<h1 style='text-align:center;'>Login</h1>",$elementsArr);
       }
    
 }

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"email"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>cannot be blank and must be a standard email</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"default@email.com",
        "regex"=>"email"
    ],
    "password"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>cannot be blank</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"",
        "regex"=>"password"
    ]   
];
/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
  global $elementsArr;  
  
  /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
      require_once('classes/Pdo_methods.php');

      $pdo = new PdoMethods();

      $sql = "SELECT * FROM admins WHERE email=:email and password=:password";

      $bindings = [
        [':email',$post['email'],'str'],
        [':password',$post['password'],'str'],
      ];

      $result = $pdo->selectBinded($sql, $bindings);

      return $result;
      
}
   
/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    
    <form method="post" action="index.php?page=login">
    <br><p style='font-style: oblique;font-size: 15px;'>admin email is "default@email.com", password is "password"</p>
    <p style='font-style: oblique;font-size: 15px;'>staff email is "email@domain.com", password is "password"</p><br>
    <div class="form-group">
      <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="password">Password {$elementsArr['password']['errorOutput']}</label>
      <input type="password" class="form-control" id="password" name="password" value="{$elementsArr['password']['value']}" >
    </div>
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Login</button>
    </div>
  </form>
HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}
