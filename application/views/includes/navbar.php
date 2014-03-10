

<div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo site_url('auth/index'); ?>">Knjizara</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Active</a></li>
    
  
    </ul>
    <form class="navbar-form navbar-left">
      <input class="form-control col-lg-8" placeholder="Search" type="text">
    </form>
    <ul class="nav navbar-nav navbar-right">
      
      <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $username?> <span class="caret"></span></a>
       
        <ul class="dropdown-menu">
          
           <li><a href="<?php echo site_url('user/korpa'); ?>">Proizvoda u korpi: <span class="badge"><?php echo $broj ?></span></a></li>
         
          <li><a href="<?php echo site_url('user/profil'); ?>">Prikazi profil</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
      <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
    </ul>
  </div>
</div>