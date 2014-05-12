



<div class="col-md-9">

  <div class="row carousel-holder">

<div class="col-md-11">


	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
			<li class="" data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li class="active" data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item">
				 <img class="img-responsive" src="<?php echo base_url('assets/img/knjizara.jpg'); ?>" alt="">
			</div>
			<div class="item">
				 <img class="img-responsive" src="<?php echo base_url('assets/img/books.jpg'); ?>" alt="">
			</div>
			<div class="item active">
				 <img class="img-responsive" src="<?php echo base_url('assets/img/strand.jpg'); ?>" alt="">
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>
	</hr>
	<h3>Deo naše ponude:</h3>
  <?php foreach ($knjige as $knjiga) { 
     
      ?> 
      <div class="col-md-3 portfolio-item">
        <div class="well">

          <a href="<?php echo base_url('user/prikazi_knjigu/'.$knjiga->id_knjige); ?>">
            <img class="img-responsive" width="188" height="420" src=<?php echo base_url('assets/img/knjige/'.$knjiga->img_name); ?>>
          </a>

          <h5>
            <a href="<?php echo base_url('user/prikazi_knjigu/'.$knjiga->id_knjige); ?>">
              <?php echo $knjiga->naziv ?>
            </a>
          </h5>
          <hr>
          <b>Autor:</b> <?php echo $knjiga->autor?>
          <br>

          <ul class="nav nav-pills">
            <li ><a href="#">Cena: <span class="badge"><?php echo $knjiga->cena?></span> din.</a></li>

          </ul>
          <b>Izdavac:</b> <?php echo $knjiga->izdavac?>

        </div>
      </div>

  
   

      <?php } ?>
        </div>
        <div class="row">
        	<div class="col-md-4"></div>
        	
        	<a href="<?php echo site_url('user/prikaziKatalog'); ?>" class="btn btn-info btn-lg" role="button">Pogledajte ceo katalog <i class="glyphicon glyphicon-book"></i></a>
        </div>

  </div>         
  
</div>





