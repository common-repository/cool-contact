<?php
####################
#start for woedpress at 30-4-2014
####################
?>

<script>
jQuery(document).ready(function() {    
 jQuery('#general_config').validate({
   
   rules: {

     toemail: {
        email: true,
	required: true
       
     },
     fromemail: {
        required: true,
         email: true
     },
       name_minlength: {
        digits: true
     },
       name_maxlength: {
        digits: true
     },
      subject_minlength: {
        digits: true
        
     },
     subject_maxlength: {
        digits: true
        
     },
     content_minlength: {
       digits: true
        
     },
     content_maxlength: {
        digits: true
     }, 
       url_maxlength: {
        digits: true
     },
      url_minlength: {
       digits: true
        
     },
     phone_maxlength: {
    digits: true
     },
      phone_minlength: {
      digits: true
        
     }
   
     
   }, //end rules
messages: {

     toemail: {
         required: "<?php _e( 'This field is required', 'ai-cool-contact' ); ?>",
         email: "<?php _e( 'This is not a vlid email address', 'ai-cool-contact' ); ?>"
       },   
      fromemail: {
         required: "<?php _e( 'This field is required', 'ai-cool-contact' ); ?>",
         email: "<?php _e( 'This is not a vlid email address', 'ai-cool-contact' ); ?>"
      },
 name_minlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
     },
       name_maxlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
     },
      subject_minlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
        
     },
     subject_maxlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
        
     },
     content_minlength: {
       digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
        
     },
     content_maxlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
     }, 
       url_maxlength: {
        digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
     },
      url_minlength: {
       digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
        
     },
     phone_maxlength: {
    digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
     },
      phone_minlength: {
      digits: "<?php _e( 'This must be only digits', 'ai-cool-contact' ); ?>"
        
     }
    } // end message

  }); // end validate 
}); // end ready        
            
</script>
 


<div class="wrap">
 
<?php

include('includes/options.php'); // for options
######
# get current user info
#####
if (!empty($_POST)) {
$toemail = $_POST['toemail'];
update_option('toemail', $toemail);
$fromemail = $_POST['fromemail'];
update_option('fromemail', $fromemail);
$requirename = (isset($_POST['requirename'])) ? '1' : '0'; // required name
update_option('requirename', $requirename);
$used_name = (isset($_POST['used_name'])) ? '1' : '0'; // used name
update_option('used_name', $used_name);
$name_minlength = $_POST['name_minlength'];
update_option('name_minlength', $name_minlength);
$name_maxlength = $_POST['name_maxlength'];
update_option('name_maxlength', $name_maxlength);
$require_email = (isset($_POST['require_email'])) ? '1' : '0'; // required email
update_option('require_email', $require_email);
$used_email = (isset($_POST['used_email'])) ? '1' : '0'; // used email
update_option('used_email', $used_email);
$used_captcha = (isset($_POST['used_captcha'])) ? '1' : '0'; // used email
update_option('used_captcha', $used_captcha);
$require_subject = (isset($_POST['require_subject'])) ? '1' : '0'; // required subject
update_option('require_subject', $require_subject);
$used_subject = (isset($_POST['used_subject'])) ? '1' : '0'; // used subject
update_option('used_subject', $used_subject);
$subject_minlength = $_POST['subject_minlength'];
update_option('subject_minlength', $subject_minlength);
$subject_maxlength = $_POST['subject_maxlength'];
update_option('subject_maxlength', $subject_maxlength);
$email_subject = $_POST['email_subject'];
update_option('email_subject', $email_subject);
// content
$content_minlength = $_POST['content_minlength'];
update_option('content_minlength', $content_minlength);
$content_maxlength = $_POST['content_maxlength'];
update_option('content_maxlength', $content_maxlength);
// sender info
$ip_address = isset($_POST['ip_address'])? '1' : '0'; // 
update_option('ip_address', $ip_address);
$user_referer = isset($_POST['user_referer'])? '1' : '0'; // 
update_option('user_referer', $user_referer);
$user_browser = isset($_POST['user_browser'])? '1' : '0'; // 
update_option('user_browser', $user_browser);
// your website
$used_url = (isset($_POST['used_url'])) ? '1' : '0'; // used subject
update_option('used_url', $used_url);
$require_url = (isset($_POST['require_url'])) ? '1' : '0'; // required subject
update_option('require_url', $require_url);
$url_minlength = $_POST['url_minlength'];
update_option('url_minlength', $url_minlength);
$url_maxlength = $_POST['url_maxlength'];
update_option('url_maxlength', $url_maxlength);
// phone
$used_phone = (isset($_POST['used_phone'])) ? '1' : '0'; // used subject
update_option('used_phone', $used_phone);
$require_phone = (isset($_POST['require_phone'])) ? '1' : '0'; // required subject
update_option('require_phone', $require_phone);
$phone_minlength = $_POST['phone_minlength'];
update_option('phone_minlength', $phone_minlength);
$phone_maxlength = $_POST['phone_maxlength'];
update_option('phone_maxlength', $phone_maxlength);
// Required symbol 
$required_symbol = $_POST['required_symbol'];
update_option('required_symbol', $required_symbol);
// send me a copy 
$send_copy = (isset($_POST['send_copy'])) ? '1' : '0'; 
update_option('send_copy', $send_copy);
?>
<div class="updated" style="width: 58%">
			<p><?php _e( 'Settings have been saved.', 'ai-cool-contact' ); ?></p>
		</div>
<?php
    }
?>
<form method="post" action="" id="general_config">
<div class="stuffbox"  style="width: 60%">
    <h3 class="hndle"><lable><?php _e( 'main settings', 'ai-cool-contact' ); ?></lable></h3>
	<div class="inside">

<table class="widefat" >
		<tr>
		<td><?php _e( 'to email', 'ai-cool-contact' ); ?></td>
		<td><input name="toemail" type="text" value="<?php echo $toemail; ?>" /></td>
	</tr>
	<tr>
		<td><?php _e( 'from email', 'ai-cool-contact' ); ?></td>
		<td><input name="fromemail" type="text" value="<?php echo $fromemail; ?>" /></td>
	</tr>
        	<tr>
		<td><?php _e( 'email subject', 'ai-cool-contact' ); ?></td>
		<td><input name="email_subject" type="text" value="<?php echo $email_subject; ?>" /></td>
	</tr>
	
</table>
             </div>
    </div>
<div class="stuffbox"  style="width: 60%">
	<h3><label><?php _e( 'Fields settings', 'ai-cool-contact' ); ?></label></h3>
	<div class="inside">

<table class="widefat" >
 <thead>
    <tr>
       
		<th><?php _e( 'Fields', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Used', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Required', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Minimum length', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'maximum length', 'ai-cool-contact' ); ?></th>
                	</tr>

                </thead>
      <tbody>
        
        <tr>
		
		<td><?php _e( 'Name', 'ai-cool-contact' ); ?></td>
		<td><input name="used_name" type="checkbox" <?php if ($used_name == 1) echo 'checked="checked"' ?> /></td>
		<td><input name="requirename" type="checkbox" <?php if ($requirename == 1) echo 'checked="checked"' ?> /></td>
                <td><input  class="input_length" name="name_minlength" type="text" value="<?php echo $name_minlength; ?>" /></td>
		<td><input class="input_length" name="name_maxlength" type="text" value="<?php echo $name_maxlength; ?>" /></td>
	</tr>
	
	<tr>
		
		<td><?php _e( 'subject', 'ai-cool-contact' ); ?></td>
		<td><input name="used_subject" type="checkbox" <?php if ($used_subject == 1) echo 'checked="checked"' ?> /></td>
		<td><input name="require_subject" type="checkbox" <?php if ($require_subject == 1) echo 'checked="checked"' ?> /></td>
		<td><input class="input_length" name="subject_minlength" type="text" value="<?php echo $subject_minlength; ?>" /></td>
		<td><input class="input_length" name="subject_maxlength" type="text" value="<?php echo $subject_maxlength; ?>" /></td>
	</tr>
 
        	<tr>
		
		<td><?php _e( 'Your website', 'ai-cool-contact' ); ?></td>
		<td><input name="used_url" type="checkbox" <?php if ($used_url == 1) echo 'checked="checked"' ?> /></td>
		<td><input name="require_url" type="checkbox" <?php if ($require_url == 1) echo 'checked="checked"' ?> /></td>
		<td><input class="input_length" name="url_minlength" type="text" value="<?php echo $url_minlength; ?>" /></td>
		<td><input class="input_length" name="url_maxlength" type="text" value="<?php echo $url_maxlength; ?>" /></td>

	</tr>
                	<tr>
		
		<td><?php _e( 'Your phone', 'ai-cool-contact' ); ?></td>
		<td><input name="used_phone" type="checkbox" <?php if ($used_phone == 1) echo 'checked="checked"' ?> /></td>
		<td><input name="require_phone" type="checkbox" <?php if ($require_phone == 1) echo 'checked="checked"' ?> /></td>
		<td><input class="input_length" name="phone_minlength" type="text" value="<?php echo $phone_minlength; ?>" /></td>
		<td><input class="input_length" name="phone_maxlength" type="text" value="<?php echo $phone_maxlength; ?>" /></td>

	</tr>
               	<tr>
		<td><?php _e( 'content', 'ai-cool-contact' ); ?></td>
		<td></td>
		<td>&nbsp;</td>
		<td><input class="input_length" name="content_minlength" type="text" value="<?php echo $content_minlength; ?>" /></td>
		<td><input class="input_length" name="content_maxlength" type="text" value="<?php echo $content_maxlength; ?>" /></td>

	</tr>
        <tr>
		<td><?php _e( 'E-Mail Address', 'ai-cool-contact' ); ?></td>
		<td><input name="used_email" type="checkbox" <?php if ($used_email == 1) echo 'checked="checked"' ?> /></td>
		<td><input name="require_email" type="checkbox" <?php if ($require_email == 1) echo 'checked="checked"' ?> /></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><?php _e( 'captcha', 'ai-cool-contact' ); ?></td>
		<td><input name="used_captcha" type="checkbox" <?php if ($used_captcha == 1) echo 'checked="checked"' ?> /></td>

		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
        </tbody>
                        <tfoot>
    <tr>
       
		<th><?php _e( 'Fields', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Used', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Required', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'Minimum length', 'ai-cool-contact' ); ?></th>
		<th><?php _e( 'maximum length', 'ai-cool-contact' ); ?></th>
                	</tr>

                </tfoot>   
</table>
                      </div>
    </div>
  <div class="stuffbox"  style="width: 60%">
	<h3><label><?php _e( 'options', 'ai-cool-contact' ); ?></label></h3>
	<div class="inside">  
<table class="widefat">
	<tr>
		<td rowspan="3"><?php _e( 'Display more user info', 'ai-cool-contact' ); ?></td>
		<td>
		
			<input name="ip_address" type="checkbox" <?php if ($ip_address == 1) echo 'checked="checked"'; ?> /><?php _e( 'The sender ip address', 'ai-cool-contact' ); ?> (188.93.174.53) 
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><input name="user_referer" type="checkbox"  <?php if ($user_referer == 1) echo 'checked="checked"'; ?> /> <?php _e( 'Where The sender came from ', 'ai-cool-contact' ); ?> (http://www.abdulibrahim.com) </td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><input name="user_browser" type="checkbox" <?php if ($user_browser == 1) echo 'checked="checked"'; ?> /><?php _e( 'The sender browser', 'ai-cool-contact' ); ?> (Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.5 Safari/537.36)</td>
		<td>&nbsp;</td>
	</tr>
        	<tr>
		<td><?php _e( 'Required symbol', 'ai-cool-contact' ); ?></td>
		<td><input name="required_symbol" type="text" value="<?php echo $required_symbol; ?>" /></td>
	</tr>
        	<tr>
		<td><?php _e( 'send me a copy', 'ai-cool-contact' ); ?></td>
		<td>  <input name="send_copy" type="checkbox" <?php if ($send_copy == 1) echo 'checked="checked"'; ?> />  </td>
	</tr>

	</table> 
              </div>
    </div>
<p><input name="Save" type="submit" value="Save Options" class="button-primary"/></p>
	
</form>
</div>