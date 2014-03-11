<?php $this->load->view('includes/header.php');?>

<body>

<div class="row">
        <div class="col-md-9">          

              <?php echo form_open("auth/register_user",'class="bs-example form-horizontal"');?>
               <h2 class="form-signup-heading">Unesite podatke za registaciju</h2>

        <fieldset>
          <legend>Unos novog korisnika </legend>
                               

         <div class="form-group">
        <label class="col-lg-2 control-label" for="FirstName">First name:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="firstname" placeholder="First name...">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="lastname">Last name:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="lastname" placeholder="Last name...">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Username:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="username" placeholder="Username...">
        </div>                
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="password">Password:</label>
       
        <div class="col-lg-10">
            <input type="password"  class="form-control" name="password" placeholder="Password...">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="passconf">Repeat password:</label>
       
        <div class="col-lg-10">
            <input type="password" class="form-control" name="passconf" placeholder="Repeat password...">
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label"  for="email">Email:</label>
        
        <div class="col-lg-10">
            <input class="form-control" type="text" class="form-control" name="email" placeholder="Email...">
        </div>
         <div class="col-lg-10">
            <input class="form-control" type="hidden" class="form-control" name="user-group" value="2">
        </div>

         
    </div>
                           
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-success" type="submit">Create User</button>
 <a href="<?php echo site_url('auth/show_register'); ?>" type="button"><button class="btn btn-default">Cancel</button></a>
       </div>
    </div>
    
            </fieldset>                 
                   <?php echo form_close();?>
            <div class="col-md-2">     
            </div>
<ul class="pager">
  <li class="previous"><a href="<?php echo site_url('auth'); ?>">← Nazad</a></li>
 
</ul>



<?php $this->load->view('includes/footer.php');?>