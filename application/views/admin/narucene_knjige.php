
<div class="col-md-9">

  <div class="col-lg-12">
    <div class="page-header">

    
      <h1 >  Narucene knjige   <i class="glyphicon glyphicon-shopping-cart "></i> </h1>


      <div class="bs-example table-responsive">
        <table class="table table-striped table-bordered table-hover" id="tabela">
          <thead>
            <tr>
              <th>#</th>
              <th>Kupac</th>
              <th>Knjiga</th>
              <th>Autor</th>
              <th>Cena</th>
            </tr>
          </thead>

         
          <tbody>

            <?php

            $rbr=0;
            foreach ($knjige as $knjiga) {
              $rbr+=1;     ?>
              <tr>
               <td>  <?php echo $rbr ?></td>
               <td> <?php echo $knjiga->first_name ." ".$knjiga->last_name?> </td>
               <td> <?php echo $knjiga->naziv ?> </td>
               <td> <?php echo $knjiga->autor ?> </td>
               
               <?php if ($knjiga->cena >1250 && $knjiga->cena <2000 ) {?>
               <td><span class="label label-warning"> <?php echo $knjiga->cena; echo " din." ?></span>  </td>
               <?php  } ?>
               <?php if ($knjiga->cena >=2000) {?>
               <td><span class="label label-danger"> <?php echo $knjiga->cena; echo " din." ?></span>  </td>
               <?php  } ?>
               <?php if ( $knjiga->cena >500 && $knjiga->cena <=1250 ) {?>
               <td><span class="label label-info"> <?php echo $knjiga->cena; echo " din." ?></span>  </td>
               <?php  } ?>
               <?php if ( $knjiga->cena <=500 ) {?>
               <td><span class="label label-success"> <?php echo $knjiga->cena; echo " din." ?></span>  </td>
               <?php  } ?>


               <!--Forma za brisnje knjige iz korpe -->
               <td>
                     <div class="col-md-3">
                     </div>
                 <?php echo form_open("admin/",'class="bs-example form-horizontal"');?>
                 <input type="hidden" name="id_knjige" value="<?php echo $knjiga->id_knjige?>">
                 <a href="#" type="submit"><button class="btn btn-success btn-sm">
                Odobri    <i class="glyphicon glyphicon-check"></i></button></a>
                   <?php echo form_close();?> </td>
                 </tr>
                 <?php
               }?>
               <tr > 
                <td> </td>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                
                <td class="info"> UKUPNO </td>

                <td class="info"><span > <?php echo $cena; echo " din." ?></span>  </td>

                
                   <td>
                  
                       <div class="col-md-6">

                     <?php echo form_open("user/",'class="bs-example form-horizontal"');?>

                   <a href="#" type="submit"><button class="btn btn-success ">
                  Odobri sve <i class="glyphicon glyphicon-check"></i></b></button></a>
                   <?php echo form_close();?> 
                    </div>
                 </td>

             
            
             </tr>    



           </tbody>
         </table>

       </div>
     </div>

   </div>