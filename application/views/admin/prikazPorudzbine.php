<div class="col-md-9">
    <div class="well">

        <h1 class="page-header"> Detalji porudžbine:

            <div class="row">
        </h1>
        <div class="bs-example table-responsive">
            <table class="table table-striped table-bordered table-hover" id="tabela">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Naziv knjige</th>
                        <th>Autor</th>
                        <th> </th>
                        <th>Izdavac</th>
                        <th>Cena</th>
                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($stavke as $stavka) { ?> 
                        <tr>
                            <td>
                                <?php echo $stavka->id_stavke ?>
                            </td>
                            <td>
                                <?php echo $stavka->naziv ?>
                            </td>
                            <td>
                                <?php echo $stavka->autor ?>
                            </td>


                            <td> <a href="<?php echo base_url('user/prikazi_knjigu/' . $stavka->id_knjige); ?>">
                                    <img class="img-responsive" width="60" height="180" src=<?php echo base_url('assets/img/knjige/' . $stavka->img_name); ?>>
                                </a></td>

                            <td> <?php echo $stavka->izdavac ?> </td>
                            <?php if ($stavka->cena > 1250 && $stavka->cena < 2000) { ?>
                                <td><span class="label label-warning"> <?php echo $stavka->cena;
                        echo " din."
                                ?></span>  </td>
                            <?php } ?>
                                    <?php if ($stavka->cena >= 2000) { ?>
                                <td><span class="label label-danger"> <?php echo $stavka->cena;
                                        echo " din."
                                        ?></span>  </td>
                                    <?php } ?>
                                    <?php if ($stavka->cena > 500 && $stavka->cena <= 1250) { ?>
                                <td><span class="label label-info"> <?php echo $stavka->cena;
                                echo " din."
                                        ?></span>  </td>
                                    <?php } ?>
                            <?php if ($stavka->cena <= 500) { ?>
                                <td><span class="label label-success"> <?php echo $stavka->cena;
                        echo " din."
                        ?></span>  </td>
    <?php } ?>
<?php } ?>
                    </tr>    
<?php foreach ($porudzbina as $p) { ?> 
                        <tr>
                            <td></td>

                            <td class="warning">Podaci o porudzbini:  <i class="glyphicon glyphicon-tasks pull-right"></i></td>
                            <td class="info">Korisnik: <i class=" glyphicon glyphicon-user pull-right"></i><br> <b>
    <?php echo $p->first_name . " " . $p->last_name ?>  </b></td>

                            <td class="info">Vreme realizacije: <i class=" glyphicon glyphicon-calendar pull-right"></i> <br> <b>
                        <?php echo $p->vreme ?></b> </td>
                            <td class="info">Ukupan iznos porudzbine:<br> <i class="glyphicon glyphicon-list-alt"></i> 
                            <td class="success"> <h4><span class="label label-info"><?php echo $cenaPorudzbine ?> din.</span></h4></td>
                            </td>
                        </tr>
<?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><td>
                            <div class="col-md-3">
                            </div>
                            <a href="<?php echo site_url('admin/odobriPorudzbinu/' . $id_porudzbine); ?>" >
                                <button class="btn btn-success btn-md">
                                    Odobri    <i class="glyphicon glyphicon-check"></i></button></a>

                        </td></td>

                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</div>
</div>
