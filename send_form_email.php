<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "rshak001@plattsburgh.edu";
    $email_subject = "Email from Personal Website";
 
    function died($error) {
        // your error code can go here
        echo "<h2>We are very sorry, but there were error(s) found with the form you submitted.</h2>";
        echo "<h2>These errors appear below.</h2><br /><br />";
        echo $error."<br /><br />";
        echo "<h2>Please go back and fix these errors.</h2><br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if( !isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('<h2>We are sorry, but there appears to be a problem with the form you submitted.</h2>');       
    }
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
	$captcha = $_POST['captcha']; //required
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= '<h2>The Email Address you entered does not appear to be valid.</h2><br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= '<h2>The Name you entered does not appear to be valid.</h2><br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= '</h2>The Comments you entered do not appear to be valid.</h2><br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
<h2 style="text-align:center;">Thank you for contacting Ruslan Shakirov. He will be in touch with you very soon.</h2>
 
<?php
 
}
?>