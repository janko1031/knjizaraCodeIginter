 <body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
 <a class="navbar-brand" href="<?php echo site_url('auth/index'); ?>">Knjižara</a>
       </div>
      <div class=" col-md-2 ">
</div>
   <div class=" col-md-5 ">

         <?php echo form_open_multipart("katalog/prikazi_rezultatePretrage",'class="navbar-form"');?>
       
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Unesite pojam za pretragu" name="poljePretrage" id="poljePretrage">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
         </form>
        </div>
      <ul  class="nav navbar-nav navbar-right">
       <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $user->username?> <span class="caret"></span></a>
       
              <ul class="dropdown-menu">
          
           <li><a href="<?php echo site_url('korpa/prikazi_korpu'); ?>">Proizvoda u korpi: 
           <i class="glyphicon glyphicon-shopping-cart "></i>  <span id="brojKorpa" class="badge"><?php echo $broj ?></span></a></li>
         
          
          <li class="divider"></li>
           <li name="Moje knjige"><a href="<?php echo site_url('kupovina/prikazi_kupovineKorisnika'); ?>">Moja naručivanja
                               <i class="glyphicon glyphicon-list-alt "> </i>
                            </a></li>
        </ul>
      </li>
      
        <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        
        </ul>
       
      </div>
  
</div>
