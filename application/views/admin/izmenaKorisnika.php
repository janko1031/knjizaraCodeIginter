<div class="container">
  <div class="row">

    <div class="col-md-9">
        <div class="well">


            <?php foreach ($editUser as $us ): ?>
            <?php echo form_open("admin/edit_user/".$us->id,'class="bs-example form-horizontal"');?>
            <fieldset> 
            
                <legend>Izmena korisnika: <?php echo $us->username  ?> </legend>
                  
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="FirstName" >First name:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="firstname" value="<?php echo $us->first_name?>" placeholder="First name...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="lastname">Last name:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="lastname" value="<?php echo $us->last_name  ?>" placeholder="Last name...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="username">Username:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="username" value="<?php echo $us->username  ?>" placeholder="Username...">
                    </div>                
                </div>

               <!--  <div class="form-group">
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
                </div> -->

                <div class="form-group">
                    <label class="col-lg-2 control-label"  for="email">Email:</label>

                    <div class="col-lg-10">
                        <input class="form-control" type="text" class="form-control" value="<?php echo $us->email  ?>" name="email" placeholder="Email...">
                    </div>
                </div>

        
                 <?php endforeach; ?>
        
 
      
          
           
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    
                   <button class="btn btn-success" type="submit">Update User</button>
                    <a  type="button"><button class="btn btn-default">Cancel</button></a>
                </div>
            </div>
        </fieldset>
    </form>
  
</div>
</div>           



