<div class="container">
  <div class="row">

    <div class="col-md-9">
        <div class="well">



            <?php echo form_open("admin/unesi_korisnika",'class="bs-example form-horizontal"');?>
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
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="assignTo">Status:</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="user-group">
                            <?php foreach ($groups as $group): ?>
                                <option  name="<?php echo $group->id ?>" value="<?php echo $group->id ?>">
                                    <?php echo $group->id;
                                    echo '. ';
                                    echo $group->name ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    
                   <button class="btn btn-success" type="submit">Create User</button>
                    <a href="<?php echo site_url('auth/index'); ?>" type="button"><button class="btn btn-default">Cancel</button></a>
                </div>
            </div>
        </fieldset>
    </form>



<!--  <a class="btn btn-warning" style="margin-left: 40px" href="<?php echo site_url('auth/index'); ?>" type="button"> Cancel</a></button>
       -->

</div>
</div>           



