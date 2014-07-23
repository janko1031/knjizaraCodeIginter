

<div class="col-md-9">

    <div class="col-lg-12">
        <div class="page-header">
            <h1 >Administracija korisnika </h1>
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
                        <th></th>
                        <th></th>
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
                         <td><a href="<?php echo base_url('admin/prikazi_izmenuKorisnika/'.$user->id); ?>"><button  class="btn btn-info btn-sm">Izmeni podatke <i class="glyphicon glyphicon-edit"></i></button>
                         </a></td>
                          <?php if (!$this->ion_auth->is_admin($user->id)): ?>
                          <?php echo form_open("admin/izmeni_status/".$user->id,'class="bs-example form-horizontal"');?>

                         <td><a href=""><button  class="btn btn-success btn-sm">Izmeni status u Admina <i class="glyphicon glyphicon-user "></i></button>
                         </a></td>
                         </form>
                          <?php endif; ?>
                           <?php if ($this->ion_auth->is_admin($user->id)): ?>
                          <?php echo form_open("admin/izmeni_status/".$user->id,'class="bs-example form-horizontal"');?>

                         <td><a href=""><button  class="btn btn-warning btn-sm">Izmeni status u Obicnog <i class="glyphicon glyphicon-remove "></i></button>
                         </a></td>
                         </form>
                          <?php endif; ?>
                            <?php echo form_open("admin/izbrisi_korisnika/".$user->id,'class="bs-example form-horizontal"');?>

                         <td><a href=""><button  class="btn btn-danger btn-sm">Izbrisi Korisnika <i class="glyphicon glyphicon-trash "></i></button>
                         </a></td>
                         </form>
                     </tr>
                     <?php
                 }?>
                 
                 


             </tbody>
         </table>


        </div>

    </div>

</div>