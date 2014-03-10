

      <div class="col-md-9">

                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1 >Spisak svih korisnika </h1>
                        </div>

                        <div class="bs-example table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tabela">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ime</th>
                                        <th>Prezime</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                  
                                  
                                   foreach ($users as $user) {
                                     ?>
                                       
                                      
                                       
                                       <tr>
                                       <td>  <?php echo $user->id ?></td>
                                        <td> <?php echo $user->first_name ?> </td>
                                         <td> <?php echo $user->last_name ?> </td>
                                          <td> <?php echo $user->username ?> </td>
                                           <td> <?php echo $user->email ?> </td>
                                           
                                           
                                        </tr>
                                <?php
                                      }?>
                                  
                               


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