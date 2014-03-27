<div class="col-md-9">

 <div  class="row">
<?php $broj=0;?>
  <?php foreach ($knjige as $knjiga) { 
  $broj+=1;

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
    
    <?php
      if ($broj%4==0) {?>
       </div>
       <div class="row">
         
      
      <?php }
    ?>
  <?php } ?>


</div>



<div class="row text-center">



      <ul class="pagination">
     <?php echo $links;
       ?> 

      </ul>
   

</div>

</div>
