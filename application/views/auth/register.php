<?php $this->load->view('includes/header.php');?>

<body>


           


 

              <?php echo form_open("auth/register_user",'class="bs-example form-horizontal"');?>
               <h2 class="form-signup-heading">Unesite podatke za registaciju</h2>

        <fieldset>
          <legend>Unos novog korisnika </legend>
                               

         <div class="form-group">
        <label class="col-lg-2 control-label" for="FirstName">First name:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="firstname"  placeholder="First name..." required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="lastname">Last name:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="lastname" placeholder="Last name..." required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="username">Username:</label>
        
        <div class="col-lg-10">
            <input type="text" class="form-control" name="username" placeholder="Username..." required>
        </div>                
    </div>

   
  <div class="form-group">
        <label class="col-lg-2 control-label"  for="email">Email:</label>
        
        <div class="col-lg-10">
            <input class="form-control" type="text" class="form-control" name="email" id="email" placeholder="Email..." required>
        </div>
         <div class="col-lg-10">
            <input class="form-control" type="hidden" class="form-control" name="user-group" value="2">
        </div>

        <div id="ispisi2"></div> 
    </div>
     <div class="form-group">
        <label class="col-lg-2 control-label" for="password">Password:</label>
       
        <div class="col-lg-10">
            <input type="password"  class="form-control" name="password" placeholder="Password..." required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label" for="passconf">Repeat password:</label>
       
        <div class="col-lg-10">
            <input type="password" class="form-control" name="passconf" placeholder="Repeat password..." required>
        </div>
    </div>

  
                           
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-success" id="submit" type="submit">Create User</button>
 <a href="<?php echo site_url('auth/show_register'); ?>" type="button"><button class="btn btn-default">Cancel</button></a>
       </div>
    </div>
    
            </fieldset>                 
                   </form>

            <div class="col-md-2">     
            </div>
<ul class="pager">
  <li class="previous"><a href="<?php echo site_url('auth'); ?>">← Nazad</a></li>
 
</ul>

          </div>
  <script type="text/javascript">

 

   $('#email').blur(function() {

  //var title = $('#title').val();

  var form_data = {
    email:$('#email').val(),
    ajax: '1'  ,

  }
  $.ajax({
    url: "<?php echo site_url('auth/proveriEmail'); ?>",
    type: 'POST',
    data: form_data,
    success: function(responseText) {
      $('#success').show();
      if (responseText==1) {
    $('#ispisi2').html("<?php echo "Navedena e-mail adresa vec postoji u bazi. Molimo, unesite novu e-mail"?> ");
     $('#submit').attr('disabled','disabled');
    }
     if (responseText==0) {
$('#ispisi2').html("<?php echo "Navedena e-mail adresa je validna"?> ");
     $('#submit').removeAttr('disabled');

    }

    }
  });
   

  return false;
  });

  </script>


<?php $this->load->view('includes/footer.php');?>