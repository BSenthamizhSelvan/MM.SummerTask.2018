
<div class="container-fluid regist">
    <h2>User Registration</h2>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="User Name" required="" value="<?php echo !empty($user['username'])?$user['username']:''; ?>">
          <?php echo form_error('username','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="" value="<?php echo !empty($user['email'])?$user['email']:''; ?>">
          <?php echo form_error('email','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" required="">
          <?php echo form_error('cpassword','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
            <input type="submit" name="regsubmit" class="btn btn-success" value="Submit"/>
        </div>
    </form>
    <p class="footInfo">Already have an account? <a href="<?php echo base_url(); ?>users/login">Login here</a></p>              
</div>
