
<div class="container-fluid">
    <div class="col-xs-12">
        <?php 
        if(!empty($success_msg)){
            echo '<div class="alert alert-success">'.$success_msg.'</div>';
        }elseif(!empty($error_msg)){
            echo '<div class="alert alert-danger">'.$error_msg.'</div>';
        }
        ?>
    </div>
    <h2>User Login</h2>
    <form action="" method="post">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="User Name" required="" value="">
            <?php echo form_error('username','<span class="help-block">','</span>'); ?>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required="">
          <?php echo form_error('password','<span class="help-block">','</span>'); ?>
      </div>
        <div class="form-group">
        <input type="submit" name="lgn" class="btn-primary" value="Submit"/>
        </div>
    </form>
    <p class="footInfo">Don't have an account? <a href="<?php echo base_url(); ?>users/register">Register here</a></p>
</div>
