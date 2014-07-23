<div class="col-md-9">
    <div class="well">

      <div class="row">
        <h1 class="page-header"> Podaci o kupovinama korisnika: <i class="glyphicon glyphicon-book"></i>

          
        </h1>
        <div class="bs-example table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tabela">
                <thead>
                    <tr>
                       <th>#</th>
                        <th>Datum obavljene kupovine</th>
                      
                        <th>Detaljan prikaz</th>
                    </tr>
                </thead>


                <tbody>
                <?php    foreach ($kupljene as $k) {?>
                   <tr>
                     <td><?php echo $k->id_porudzbine; ?></td> 
                      <td><?php echo $k->vreme; ?></td> 
         <td><a href="<?php echo site_url('kupovina/prikazi_porudzbinu/' . $k->id_porudzbine); ?>" >
                       <button class="btn btn-success btn-sm">
              Prikazi detalje kupovine    <i class="glyphicon glyphicon-saved"></i></button></a></td>  

                   </tr>
                   <?php } ?>
                </tbody>
            </table>

        </div>

    </div>
    </div>
    <div class="well">
      <div class="row">
        <h1 class="page-header"> Podaci o porudžbinama korisnika: <i class="glyphicon glyphicon-list-alt"></i>

          
        </h1>
        <div class="bs-example table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tabela">
                <thead>
                    <tr>
                       <th>#</th>
                        <th>Vreme naručivanja</th>
                      
                        <th>Detaljan prikaz</th>
                    </tr>
                </thead>


                <tbody>
                <?php    foreach ($porudzbine as $p) {?>
                   <tr>
                     <td><?php echo $p->id_porudzbine; ?></td> 
                      <td><?php echo $p->vreme; ?></td> 
         <td><a href="<?php echo site_url('kupovina/prikazi_porudzbinu/' . $p->id_porudzbine); ?>" >
                       <button class="btn btn-info btn-sm">
              Prikazi detalje porudzbine    <i class="glyphicon glyphicon-tasks"></i></button></a></td>  

                   </tr>
                   <?php } ?>
                </tbody>
            </table>

        </div>

    </div>
</div>
</div>
