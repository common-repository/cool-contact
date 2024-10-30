<?php
function ab_contact_action_callback(){
  load_plugin_textdomain( 'ai-cool-contact', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
  
 
  include('securimage/securimage.php');
 include('includes/functions.php');
 include('includes/options.php');
$securimage = new Securimage();
    $mail_to = $toemail ; // admin
    $mail_addr['from'] = $fromemail; // admin
    $email_subject = $email_subject; // admin
    //  sender info
    $ipaddress = $_SERVER["REMOTE_ADDR"];
    $userbrowser = $_SERVER["HTTP_USER_AGENT"];
##################
# check for used and unused fields
# chck for required and not required fields
##################
   
$required = array('content'); // to check required fileds
if($used__mail == 1 && $require__mail == 1){
array_push($required, "email");

}
if($used_name == 1 && $requirename == 1){
array_push($required, "name");    
}
if($used_subject == 1 && $require_subject == 1){
array_push($required, "subject");    
}
if($used_url == 1 && $require_surl == 1){
array_push($required, "url");    
}
if($used_phone == 1 && $require_sphone == 1){
array_push($required, "phone");    
}
//#####################################
                 
                    $error = false;
                    foreach($required as $field) {
                    if (empty($_POST[$field])) {
                        $error = true;
                      }
                    }
                    $_POST=array_map("strip_tags",$_POST);// srip all tags
                    if (!empty($_POST )) extract($_POST, EXTR_PREFIX_SAME, "wddx"); //extract $_POST key to become variable name
                    if (!empty($email)){
                        
                     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // validate email address
                     $error = true;
                     }    
                        
                    }

                    if (!$error){
                        
                  stripslashes_array($_POST);
                  
                  $email_body =__( 'you got the follwing Message', 'ai-cool-contact' );
                  $email_body .= "<br>";  // break before the name
                  if (!empty($name)){
                      
                   $email_body .= __( 'by', 'ai-cool-contact' )."  $name <br>";                  
                  } 
                  if (!empty($subject)){
                      
                   $email_body .= __( 'The Subject is: ', 'ai-cool-contact' ) . "$subject <br>";                  
                  }
                  
                  $email_body .= "<br>".__( 'The Message is: ', 'ai-cool-contact' )."<br>" . $content . " <br>";
                  $email_body .= "----------------. " .__( 'The sender information ', 'ai-cool-contact' ) ." .----------------<br>"; 

                  if (!empty($email)){
                    
                   $email_body .=  __( 'The sender email is: ', 'ai-cool-contact' ). "$email <br>";
                       if ( isset($_POST['send_copy'])){ /// send a copy for the sender if the checked box is checked
                       $mail_addr['bcc'] = $email;                  
                         }
                  }
                  if (!empty($url)){
                        
                   $email_body .= __( 'The sender website is: ', 'ai-cool-contact' ) ." $url <br>";                  
                  }
                  if (!empty($phone)){
                      
                   $email_body .= __( 'The sender phone is: ', 'ai-cool-contact' ) ."$phone <br>";                  
                  }
                  if ($ip_address == 1){
                      
                   $email_body .= __( 'The sender ip address is: ', 'ai-cool-contact' ) . "$ipaddress <br>";                  
                  }
                  if ($user_referer == 1 && strlen($userreferer)> 0){ // check if the referre hs value
                    
                   $email_body .=  __( 'The sender came from: ', 'ai-cool-contact' )  . " $userreferer <br>";                  
                  } elseif ($user_referer == 1 && strlen($userreferer)< 0){
                  $email_body .=  __( 'The sender came from: ', 'ai-cool-contact' )  . __( 'directly has no referer', 'ai-cool-contact' ) ." <br>";       
                  }
                  if ($user_browser== 1){
                        
                   $email_body .= __( 'The sender browser is: ', 'ai-cool-contact' ) . "$userbrowser <br>";                  
                  }
      
                    }

                if ($used_captcha == 1){  // enableable capcha if it's used   
               if ($securimage->check($_POST['captcha_code']) == false) { // check capcha
                   $result= "captcha";  // captcha is wrong
                   echo $result;
                    exit;
                     }
                  }
           

    
        if ($error) {
  echo "fail";
} else {
    
    $result= "pass"; // it's ok
     echo $result;
     // remove slashes from the email
    $email_subject = stripcslashes($email_subject);
    $email_body = stripcslashes($email_body);
    // set mail set_content_type to text/html
    add_filter( 'wp_mail_content_type', 'set_content_type' );
    function set_content_type( $content_type ){
            return 'text/html';
    }  
    wp_mail( $mail_to , $email_subject, $email_body, $mail_addr);
     
     // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
     remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

}
                          
                       
die();             
           
  }           


?>