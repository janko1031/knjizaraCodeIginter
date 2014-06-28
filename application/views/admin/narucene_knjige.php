
<div class="col-md-9">

    <div class="col-lg-12">
        <div class="page-header">


            <h1 >  Spisak porudžbina <i class="glyphicon glyphicon-list-alt"></i> </h1>
            <hr>

            <div class="bs-example table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tabela">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vreme naručivanja</th>
                            <th>Korisnik </th> 
                            <th>Odobravanje</th>
                            <th>Detaljan prikaz</th>
                        </tr>
                    </thead>


                    <tbody>

                        <?php
                        $rbr = 0;
                        foreach ($porudzbine as $porudzbina) {
                            $rbr+=1;
                            ?>
                            <tr>
                                <td>  <?php echo $porudzbina->id_porudzbine ?></td>
                                <td> <?php echo $porudzbina->vreme ?> </td>

                                <td> <?php echo $porudzbina->first_name . " " . $porudzbina->last_name ?> </td>
                                <!--Forma za brisnje knjige iz korpe -->
                                <td>
                                    <div class="col-md-3">
                                    </div>


                                    <input type="hidden" name="user_id" value="<?php echo $porudzbina->user_id ?>">
                                    <a href="<?php echo site_url('admin/odobriPorudzbinu/' . $porudzbina->id_porudzbine); ?>" >
                                        <button class="btn btn-success btn-sm">
                                            Odobri    <i class="glyphicon glyphicon-check"></i></button></a>

                                </td>

                                <td><a href="<?php echo site_url('admin/prikaziPorudzbinu/' . $porudzbina->id_porudzbine); ?>" >
                                        <button class="btn btn-info btn-sm">
                                            Prikazi detalje porudzbine    <i class="glyphicon glyphicon-tasks"></i></button></a></td>
                            </tr>



                            <?php }
                        ?>
                        <tr > 
                            <td> </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  </td>






                            <td>

                                <div class="col-md-6">

                                    <?php echo form_open("admin/odobri_SveKnjige", 'class="bs-example form-horizontal"'); ?>

                                    <a href="#" type="submit"><button class="btn btn-success ">
                                            Odobri sve <i class="glyphicon glyphicon-check"></i></b></button></a>
                                            <?php echo form_close(); ?> 
                                </div>
                            </td>



                        </tr>    



                    </tbody>
                </table>

            </div>
        </div>

    </div>