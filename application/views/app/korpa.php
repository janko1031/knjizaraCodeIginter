

      <div class="col-md-9">

                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1 >Korpa korisnika  <?php echo $user->username;   ?> </h1>
                        </div>

                        <div class="bs-example table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabela">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naziv</th>
                                        <th>Autor</th>
                                        <th>Godina izdanja</th>
                                        <th>Izdavac</th>
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
                                        <td> <?php echo $knjiga->naziv ?> </td>
                                         <td> <?php echo $knjiga->autor ?> </td>
                                          <td> <?php echo $knjiga->godina_izdanja ?> </td>
                                           <td> <?php echo $knjiga->izdavac ?> </td>
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
                                  </tr>    
                               


                                </tbody>
                            </table>


                            <div class="col-md-12">

                                <div class="thumbnail">

                                    <div class="caption-full">

                                        <form class="bs-example form-horizontal"  action="funkcijeBaze.php" method="POST">
                                            <input type="hidden" name="action" value="zaduzenje" />
                                            <p><div id="popuni"></div></p>

                                    </div>
                                    <div id="pomocniDiv" style="display:none">

                                        <div class="text-center">
                                            <a class="btn btn-success"  onclick="unhide()">Prikazi ostale knjige</a>

                                        </div>

                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>

                </div>