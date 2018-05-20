
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php if ($showform) : ?>
<div  class="card" style="margin:9px auto;max-width:600px;">

<div class="card-header">Contact Form.</div>


<div class="card-body">
    <form action="/contact" class="form-horizontal"  method="post" accept-charset="utf-8">   
            <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input class="form-control" name="name" data-validation="required" placeholder="Your Full Name" type="text" 
value="<?php echo set_value('name'); ?>" />
                    <span class="text-danger"><?php echo form_error('name'); ?></span>
               
            </div>

            <div class="form-group">
                
                    <label for="email" class="control-label">Email</label>
               
             
                    <input class="form-control" name="email" data-validation="required" placeholder="Your Email" type="text" value="<?php echo set_value('email'); ?>" />
                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                
            </div>

<!--
            <div class="form-group">
               
                    <label for="subject" class="control-label">Subject</label>
                
          
                    <input class="form-control" name="subject" placeholder="Your Subject" type="text" value="<?php echo set_value('subject'); ?>" />
                    <span class="text-danger"><?php echo form_error('subject'); ?></span>
              
            </div> -->

            <div class="form-group">
               
                    <label for="message" class="control-label">Message</label>
                
                    <textarea class="form-control" data-validation="required" name="message" rows="4" placeholder="Your Message"><?php echo set_value('message'); ?></textarea>
                    <span class="text-danger"><?php echo form_error('message'); ?></span>
               
            </div>

<div class="form-group">
<div class="g-recaptcha" data-sitekey="<?=$data_sitekey?>"></div>
<span class="text-danger"><?php echo form_error('g-recaptcha-response'); ?></span>
</div>

            <div class="form-group">
                    <input name="submit" type="submit" class="btn btn-primary" value="Send" />
            </div>
          
           </form>
   
</div>
</div>
<?php else: ?>

 <?php if(isset($alert_info)){?>
          <div class="alert alert-info">      
            <?php echo $alert_info;?>
          </div>
<?php } ?>

 <?php if(isset($alert_warning)){?>
          <div class="alert alert_warning">      
            <?php echo $alert_warning;?>
          </div>
<?php } ?>

<?php endif; ?>
