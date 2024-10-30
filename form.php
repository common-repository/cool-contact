<?php
$dir = plugin_dir_path( __FILE__ );
load_plugin_textdomain( 'ai-cool-contact', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
include( $dir . 'includes/functions.php');
include( plugin_dir_path( __FILE__ ) . 'includes/options.php');

$securimage_show = plugins_url( 'securimage/securimage_show.php', __FILE__ );
?>




 
<script>
jQuery(document).ready(function() {
                // this for the thank you box
                jQuery(function() {
                    jQuery( "#thank_you" ).dialog({
                      autoOpen: false,
                      show: {
                        effect: "blind",
                        duration: 1000
                      },
                      hide: {
                        effect: "explode",
                        duration: 1000
                      }
                    });
                   });
              // end the thank you box     
jQuery(':input:first').focus();   
jQuery.validator.setDefaults({ // to check sucess validation
  success: "valid"
});
var form = jQuery("#contact");
 form.validate({
 
   
   rules: {
     name: {
        <?php if ($requirename == 1) echo 'required: true,' ?> // required
        <?php if (!empty($name_minlength)) echo "minlength:$name_minlength," ?> // min
         <?php if (!empty($name_maxlength)) echo "maxlength:$name_maxlength" ?> // required    
        
     },
     email: {
    <?php if ($require_email == 1) echo 'required: true,' ?> // required
    
     email: true
     },
     subject: {
        <?php if ($require_subject == 1) echo 'required: true,' ?> // required
        <?php if (!empty($subject_minlength)) echo "minlength:$subject_minlength," ?> // min
         <?php if (!empty($subject_maxlength)) echo "maxlength:$subject_maxlength" ?> // required    
     },
      url: {
        <?php if ($require_url == 1) echo 'required: true,' ?> // required
        <?php if (!empty($url_minlength)) echo "minlength:$url_minlength," ?> // min
         <?php if (!empty($url_maxlength)) echo "maxlength:$url_maxlength," ?> // required 
         url: true    
     },            
     content: {
        required: true,
        <?php if (!empty($content_minlength)) echo "minlength:$content_minlength," ?> 
         <?php if (!empty($content_maxlength)) echo "maxlength:$content_maxlength" ?> 
       },
     
       phone: {
        <?php if ($require_phone == 1) echo 'required: true,' ?> // required
        <?php if (!empty($phone_minlength)) echo "minlength:$phone_minlength," ?> // min
         <?php if (!empty($phone_maxlength)) echo "maxlength:$phone_maxlength," ?> // required 
            
     }              
       
   }, //end rules
   messages: {
      name: {
         required: "<?php _e( 'Please supply Your name.', 'ai-cool-contact' ); ?>",
         minlength: jQuery.validator.format("<?php _e( 'At least', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters required !', 'ai-cool-contact' ); ?>"),
         maxlength: jQuery.validator.format("<?php _e( 'At most', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters long!', 'ai-cool-contact' ); ?>")
       },   
      email: {
         required: "<?php _e( 'Please supply an e-mail address.', 'ai-cool-contact' ); ?>",
         email: "<?php _e( 'This is not a valid email address.', 'ai-cool-contact' ); ?>"
       },
      subject: {
        required: "<?php _e( 'Please type a subject.', 'ai-cool-contact' ); ?>",
         minlength: jQuery.validator.format("<?php _e( 'At least', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters required !', 'ai-cool-contact' ); ?>"),
         maxlength: jQuery.validator.format("<?php _e( 'At most', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters long!', 'ai-cool-contact' ); ?>")
     },
         url: {
        required: "<?php _e( 'Please type a url.', 'ai-cool-contact' ); ?>",
         minlength: jQuery.validator.format("<?php _e( 'At least', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters required !', 'ai-cool-contact' ); ?>"),
         maxlength: jQuery.validator.format("<?php _e( 'At most', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters long!', 'ai-cool-contact' ); ?>")
     },           
      content: {
        required: "<?php _e( 'Please type a the message.', 'ai-cool-contact' ); ?>",
         minlength: jQuery.validator.format("<?php _e( 'At least', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters required !', 'ai-cool-contact' ); ?>"),
         maxlength: jQuery.validator.format("<?php _e( 'At most', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters long!', 'ai-cool-contact' ); ?>")
      },
         phone: {
        required: "<?php _e( 'Please type a phone.', 'ai-cool-contact' ); ?>",
         minlength: jQuery.validator.format("<?php _e( 'At least', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters required !', 'ai-cool-contact' ); ?>"),
         maxlength: jQuery.validator.format("<?php _e( 'At most', 'ai-cool-contact' ); ?> {0} <?php _e( 'characters long!', 'ai-cool-contact' ); ?>")
     },        
    },

  }); // end validate 

jQuery('#contact').submit(function() {
var valid_check = form.valid(); // hold true or false based on vlidation process
if( valid_check ){
   var formData = jQuery(this).serialize();
   var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        jQuery.ajax({   // to post the form data
        type: "POST",
        url: ajaxurl,
        data: formData,
        success: processData // call back function
        

      });
      function processData(data) {
	console.log(data);
        if (data=='pass') {

                    jQuery( "#thank_you" ).dialog({ position: { my: "center", at: "center", of: "#contact" } });
                      jQuery( "#thank_you" ).dialog( "open" );
                         // after submission happen enable the submit button again
                         
                         jQuery('input[type=submit]').val('<?php _e( 'Submitted', 'ai-cool-contact' ); ?>');                  
        
        }else if (data=='captcha') {
            jQuery('#captcha_box').prepend('<p id="fail"><?php _e( 'Incorrect captcha', 'ai-cool-contact' ); ?></p>');
	  jQuery('#fail').fadeOut(5000);
                         // if errors happen enable the submit button again
                         jQuery('input[type=submit]').removeAttr('disabled');
                         jQuery('input[type=submit]').val('<?php _e( 'Submit', 'ai-cool-contact' ); ?>');
        } else {
             jQuery('#formwrapper').prepend('<p id="fail"><?php _e( 'Please fill in all the required fields.', 'ai-cool-contact' ); ?></p>');
			 jQuery('#fail').fadeOut(5000);
                         // if errors happen enable the submit button again
                         jQuery('input[type=submit]').removeAttr('disabled');
                         jQuery('input[type=submit]').val('<?php _e( 'Submit', 'ai-cool-contact' ); ?>');
                   }
       } // end processData
       jQuery('input[type=submit]').attr('disabled',true);
jQuery('input[type=submit]').val('<?php _e( 'sending information...', 'ai-cool-contact' ); ?>');
       return false;
// disable submission 

    }
   }); // end submit
   
}); // end ready
</script>

   
<div>

	
	<div >

	<div>
            <div style="display: none" id="thank_you" title="<?php _e( 'Submitted', 'ai-cool-contact' ); ?>">
             <p> 
                     <?php
                    echo ' <img src="' .plugins_url( 'images/thank_you.jpg' , __FILE__ ). '"> ';
                    ?>
            </p>
  <p><?php _e( 'We received your message', 'ai-cool-contact' ); ?></p>

</div>
	<div id="formwrapper"> 
            <p class="p_require"><?php _e( 'Fields marked with', 'ai-cool-contact' ); ?> (<span class="symbol"><?php echo $required_symbol;?></span>) <?php _e( 'are required', 'ai-cool-contact' ); ?></p>
            <form action="" method="post" name="contact" id="contact">
			<div>
                          <input name="action" type="hidden" value="ab_contact_action" /> <!--  set action value for the ajax handler-->
                            <?php if ($used_name == 1){ ?>
                            
				<label for="name" class="label"><?php _e( 'Name', 'ai-cool-contact' ); ?> <span class="symbol"><?php if ($requirename == 1) echo $required_symbol;?></span></label>
				<input name="name" type="text" id="name">
                            <?php } ?>
			</div>
			<div>
                            <?php if ($used_email == 1){ ?>
				<label for="email" class="label"><?php _e( 'E-mail Address', 'ai-cool-contact' ); ?> <span class="symbol"><?php if ($require_email == 1) echo $required_symbol;?></span></label>
				<input name="email" type="text" id="e_mail">
                             <?php } ?>    
			</div>

                       <?php if ($used_url == 1){ ?>
			<div>

                            
				<label for="url" class="label"><?php _e( 'url', 'ai-cool-contact' ); ?> <span class="symbol"><?php if ($require_url == 1) echo $required_symbol;?></span></label>
				<input name="url" type="text" id="site_url">
			</div>
                 <?php } ?> 
                                       <?php if ($used_phone == 1){ ?>
			<div>

                            
				<label for="phone" class="label"><?php _e( 'phone', 'ai-cool-contact' ); ?> <span class="symbol"><?php if ($require_phone == 1) echo $required_symbol;?></span></label>
				<input name="phone" type="text" id="phone">
			</div>
                 <?php } ?> 
                                         <?php if ($used_subject == 1){ ?>
			<div>

                            
                            <label for="subject" class="label"><?php _e( 'subject', 'ai-cool-contact' ); ?> <span class="symbol"><?php if ($require_subject == 1) echo $required_symbol;?></span></label>
				<input name="subject" type="text" id="subject">
			</div>
                 <?php } ?> 
			<div>
				<label for="content" class="label"><?php _e( 'Your message', 'ai-cool-contact' ); ?> <span class="symbol"><?php echo $required_symbol;?></span></label>
				<textarea name="content" id="content_box" style="width: 250px; height: 134px"></textarea>
			</div>
			                       <?php if ($send_copy == 1){ ?>
			<div id="send_me_div">

                            
				<label for="send_copy" class="label"><?php _e( 'send me a copy', 'ai-cool-contact' ); ?></label>
				<input name="send_copy" type="checkbox" id="send_copy">
			</div>
                 <?php } ?> 			
             <?php if ($used_captcha == 1){ ?>
                
                    			<div id="captcha_box">

                            <img id="captcha" src="<?php echo $securimage_show ?>" alt="CAPTCHA Image" style="display: block"/>

			<input type="text" name="captcha_code" size="10" maxlength="6" />
                        <a href="#" onclick="document.getElementById('captcha').src = '<?php echo $securimage_show ?>?' + Math.random(); return false"><br>[<?php _e( 'Different Image', 'ai-cool-contact' ); ?>]</a>
</div>
              <?php } ?>  
                <input name="userreferer" type="hidden" value="<?php echo $_SERVER["HTTP_REFERER"] ;?>">
                <div class="indent">
				<input type="submit" name="submit" id="submit" value="<?php _e( 'Submit', 'ai-cool-contact' ); ?>" >
			</div>
                
                    
             

		</form>
            </div>
		</div>
		</div>
	</div>

</div>
