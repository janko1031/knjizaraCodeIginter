<div class="col-md-9">

 <div class="row">

  <?php foreach ($knjige as $knjiga) { ?> 
    <div class="col-md-3 portfolio-item">
      <a href="<?php echo base_url('user/prikazi_knjigu'); ?>">
        <img class="img-responsive" width="188" height="420" src=<?php echo base_url('assets/img/knjige/'.$knjiga->img_name); ?>>
      </a>
      <h3>
        <a href="#project-link">
          <?php echo $knjiga->naziv ?>
        </a>
      </h3>
      <p align="justify"><?php echo $knjiga->opis ?></p>
    </div>
  <?php } ?>


</div>


<hr>

<div class="row text-center">

  <div class="col-lg-12">
    <ul class="pagination">
      <li><a href="#">&laquo;</a>
      </li>
      <li class="active"><a href="#">1</a>
      </li>
      <li><a href="#">2</a>
      </li>
      <li><a href="#">3</a>
      </li>
      <li><a href="#">4</a>
      </li>
      <li><a href="#">5</a>
      </li>
      <li><a href="#">&raquo;</a>
      </li>
    </ul>
  </div>

</div>

</div>

