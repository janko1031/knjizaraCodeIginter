  <div class="col-md-9">
   <div class="well">


    <?php foreach ($knjige as $knjiga) { ?> 
    <div class="row">

      <div class="col-md-12">
        <h1 class="page-header"> <?php echo $knjiga->naziv ?>
          <small><?php echo $knjiga->autor ?></small>
        </h1>
      </div>

    </div>

    <div class="row">

      <div class="col-md-6">
        <img class="img-responsive" width="350" height="700" src="<?php echo base_url('assets/img/knjige/'.$knjiga->img_name); ?>">
      </div>

      <div class="col-md-6">
        <h3>Opis knjige: </h3>
        <p align="justify"><?php echo $knjiga->opis ?></p>

        <h3>Detalji knjige:</h3>

        <ul>
          <li><b>Godina izdanja: </b><?php echo $knjiga->godina_izdanja ?></li>
          <li><b>Broj strana: </b><?php echo $knjiga->br_strana ?></li>
          <li><b>Zanr: </b><?php echo $knjiga->zanr ?></li>
          <li><b>Izdavac: </b><?php echo $knjiga->izdavac ?></li>
        </ul>
        <h3>Prosečna ocena čitalaca:  </h3>
        <?php 
        echo   "";
        switch ($ocena) {
          case 1:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 2:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>

          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 3:
          echo     '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 4:
          echo      '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 5:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          break;

        }

        ?>
        <b> <?php echo  $ocena ?> </b>
        <hr> 
        <div class="list-group">
          <a href="#" class="list-group-item">
            <h3 class="list-group-item-heading"><i class=" glyphicon glyphicon-tags"></i>     Cena knjige: <?php echo $knjiga->cena ?> din.          
            </h3>
            <p class="list-group-item-text"> </p>
          </a>
          <a  class="list-group-item">
            <div class="col-md-4">

            </div>


            <?php echo form_open("user/ubaciUKorpu",'class="bs-example form-horizontal"');?>
            <input type="hidden" name="id_knjige" id="id_knjige" value="<?php echo $knjiga->id_knjige?>">
            <button class="btn btn-success " type="submit" id="submit">
              Ubaci u korpu <i class="glyphicon glyphicon-shopping-cart"></i></button>
              <?php echo form_close();?> 
            </a>
            <a  id="success" class="list-group-item" style="display:none">
              <div class="alert alert-dismissable alert-success">
                <button type="button" class="close" id="closeMessage" >×</button>
                <strong>YEAH Bitch!</strong> Uspešno ubačena knjiga u korpu 
              </div>
              

            </a>
          </div>



        </div>

      </div>
      <?php } ?>
      <div class="row">

        <div class="col-lg-12">
          <h3 class="page-header">Slicne knjige</h3>
        </div>
        <?php foreach ($slicne as $slicna) { ?> 
        <div class="col-sm-2 col-xs-6">
          <a href="<?php echo base_url('user/prikazi_knjigu/'.$slicna->id_knjige); ?>">
           <img class="img-responsive" src="<?php echo base_url('assets/img/knjige/'.$slicna->img_name); ?>">
         </a>
       </div>
       <?php } ?>
     </div>
   </div><!--well1-->



   <div class="well">

     <div class="row">
       <h3 class="page-header">Recenzije korisnika</h3>

       <div class="col-md-12">

         <?php foreach ($recenzije as $recenzija) { ?> 
         Korisnik:
         <b> <?php echo $recenzija->first_name?> </b>
         <b> <?php echo $recenzija->last_name?> </b>


         <p>Recenzija: <b> <?php echo $recenzija->opis?> </b></p>

         <?php 
         echo "Ocena: ";
         switch ($recenzija->ocena) {
          case 1:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 2:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>

          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 3:
          echo     '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 4:
          echo      '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star-empty"></span>';
          break;
          case 5:
          echo '<span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>
          <span class="glyphicon glyphicon-star"></span>';
          break;

        }

        ?>
        <hr>   <?php } ?>

      </div>
    </div>
    
    <?php if (!$ocenjena) {?>
    

    <?php echo form_open("user/napisi_recenziju",'class="bs-example form-horizontal"');?>

    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Tekst recenzije</label>
      <input type="hidden" name="id_knjige" value="<?php echo $knjiga->id_knjige?>">
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" name="opis" data-validation="length" data-validation-length="min6" ></textarea>


      </div>
    </div>
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Ocena knjige</label>
      <div class="col-lg-10">
        <select multiple="" class="form-control" name="ocena">

          <option value="1"> Ocena 1 </option>
          <option value="2"> Ocena 2 </option>
          <option value="3"> Ocena 3 </option>
          <option value="4"> Ocena 4 </option>
          <option value="5"> Ocena 5 </option>

        </select>
      </div>

    </div>

    <div class="text-right">

      <button class="btn btn-success" type="submit">
       Napisi recenziju  <i class="glyphicon glyphicon-comment"></i>  </button>

     </div>
   </form>
   <?php } ?>

   <?php if ($ocenjena) {?>
   <?php echo form_open("user/izbrisi_recenziju",'class="bs-example form-horizontal"');?>
   <div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    Mozete <strong>samo jednom</strong>  oceniti knjigu.
  </div>
  <input type="hidden" name="brisanje">
  <input type="hidden" name="id_knjige" value="<?php echo $knjiga->id_knjige?>">
  <div class="text-right">

    <button class="btn btn-danger" type="submit">
      Izbrisi recenziju   <i class="glyphicon glyphicon-trash"></i>  </button>

    </form> 
    <?php } ?>

  </div>
  <script type="text/javascript">
   
    $('#submit').click(function() {

  //var title = $('#title').val();

  var form_data = {
    id_knjige:$('#id_knjige').val(),
    ajax: '1'  ,

  }
  $.ajax({
    url: "<?php echo site_url('user/ubaciUKorpu'); ?>",
    type: 'POST',
    data: form_data,
    success: function() {
      $('#success').show();
      $('#brojKorpa').html("<?php echo $broj+1 ?> ");
    }
  });
   $('#closeMessage').click(function() {

     $('#success').hide();

    });

  return false;
  });

  </script>
</div>
