<?php $this->load->view('includes/header.php');?>


    <body>
<div class="container">
<?php echo form_open("auth/login", 'class="form-signin"');?>

      <form class="form-signin" role="form">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus name="identity">
        <input type="password" class="form-control" placeholder="Password" required name="password">
        <label class="checkbox">
         <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
   Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      </form>
      <div class="col-md-5">   
      </div>  
      <div class="col-md-2">     
<a href="<?php echo site_url('auth/show_register'); ?>" >
<button class="btn btn-lg btn-primary btn-block" type="button" name="Login">Registruj se</button></a>
        </div>

    </div>
        
        
    </body>
     <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</html>