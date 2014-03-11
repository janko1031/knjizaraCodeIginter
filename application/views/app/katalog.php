<div class="col-md-9">

    <div class="row">
<?php  foreach ($knjige as $knjiga) { ?>
    


      <div class="col-md-4 portfolio-item">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h5 class="panel-title"><a href="knjiga"><b><?php echo $knjiga->naziv?></b></a></h5>


          </div>
          <div class="panel-body">
         
              <div class="pull-left">  <b>Autor:</b> <?php echo $knjiga->autor?></div>
                <hr>
               <div class="pull-left"><b>Izdavac: </b> <?php echo $knjiga->izdavac?>  </div>
              <div class="pull-right"><?php echo $knjiga->godina_izdanja?></div> 
              
             
                
               <div class="pull-left"><b>Br. strana: </b><?php echo $knjiga->brStrana?></div> 
              <?php if ($knjiga->kolicina > 1)
              {
                ?>
            <div class="pull-right"> Dostupna kolicina: <span class="label label-info"><?php echo $knjiga->kolicina?></span></div>
            <?php }?> 
           <?php  if ($knjiga->kolicina <1){?>
            <div class="pull-right">Dostupna kolicina: <span class="label label-danger"><?php$knjiga->kolicina ?></span></div>
            <?php }?>  
            </br> 
            </br> 
             <hr>
    <div class="col-md-2"> </div>  
    <div class="col-md-3"> 
       <?php echo form_open("user/ubaciUKorpu",'class="bs-example form-horizontal"');?>
       <input type="hidden" name="id_knjige" value="<?php echo $knjiga->id_knjige?>">
     <a href="<?php echo site_url('auth/show_register'); ?>" type="submit"><button class="btn btn-success">
     <i class="glyphicon glyphicon-shopping-cart"></i> Dodaj u korpu</button></a>
      <?php echo form_close();?>
    </div>  
      
   
      
      </div>
  </div>

</div>     

<?php }?>      

</div>