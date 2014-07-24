<div class="container"><!-- sadrzi glavni deo sajta meni i sadrzaj-->
    <div class="row">

        <div class="col-md-3">

              <div class="well sidebar-nav">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-responsive-collapse">
              <a>  <span class="glyphicon glyphicon-align-justify"></span></a>
          
            </button>
               <a> <h4>Glavni meni</h4></a> 
                        <ul class="nav nav-list nav-collapse collapse nav-responsive-collapse" id="sidebar-nav">
                           <?php if ($this->ion_auth->logged_in() ){ ?>
          
                            
                        
                            <li name="pocetna"><a href="<?php echo site_url('auth/index'); ?>" > <i class="glyphicon glyphicon-home "></i> Početna </a></li>
                            <li name="katalog"><a href="<?php echo site_url('katalog/prikazi_katalog'); ?>">Katalog knjiga <i class="glyphicon glyphicon-book pull-right"></i></a></li>
                            <li name="korpa"><a href="<?php echo site_url('korpa/prikazi_korpu'); ?>">Moja korpa <i class="glyphicon glyphicon-shopping-cart pull-right"> </i>
                            </a></li>
                              <li name="MojeKnjige"><a href="<?php echo site_url('kupovina/prikazi_kupovineKorisnika'); ?>">Moja naručivanja
                               <i class="glyphicon glyphicon-list-alt pull-right"> </i>
                            </a></li>  <?php }?>
                              <?php if (!$this->ion_auth->logged_in() ){ ?>
                                                          <li name="top" class="nav-header">Glavni meni</li> 
                                               <li name="pocetna"><a href="<?php echo site_url('auth/index'); ?>" > <i class="glyphicon glyphicon-home "></i> Početna </a></li>
 
                                              <li name="katalog"><a href="<?php echo site_url('auth/prikaziKatalogGuest'); ?>">Katalog knjiga <i class="glyphicon glyphicon-book pull-right"></i></a></li>
          
                              <?php }?>
          </a></li>
                            <?php if ($this->ion_auth->is_admin()): ?>
                               <li name="top" class="nav-header">Admin deo</li> 
                                    <li name="noviKorisnik"><a href="<?php echo site_url('admin/prikazi_unosKorisnika'); ?>">Dodavanje korisnika <i class=" glyphicon glyphicon-user pull-right"></i>
                                    <i class="glyphicon glyphicon-plus pull-right"></i></a></li>
                                    <li name="NovaKnjiga"><a href="<?php echo base_url('admin/prikazi_unosKnjige'); ?>">Dodavanje knjige <i class="glyphicon glyphicon-book pull-right"></i><i class="glyphicon glyphicon-plus pull-right"></i></a></li> 
                                    <li name="top" class="nav-header ">Administracija</li>
                                    <li name=""><a href="<?php echo base_url('admin/prikazi_sveKorisnike'); ?>">Administracija korisnika <i class="glyphicon glyphicon-user pull-right"></i></a></li>
                                    <li name="porudzbine"><a href="<?php echo base_url('admin/prikazi_porudzbine'); ?>">Adminstracija proudžbina <i class="glyphicon glyphicon-list-alt pull-right"></i></a></li>
                                    <li name="statistike"><a href="<?php echo base_url('user/prikazi_statistiku'); ?>">Statistike prodaje <i class="glyphicon glyphicon-stats pull-right"></i></a></li>
                                <?php endif; ?>
                    
                   

            <legend ><a href="">  <i class="glyphicon glyphicon-sort-by-attributes-alt"></i> Filtiranje kataloga </a></legend>

                <?php echo form_open_multipart("katalog/filtriraj_poCeni", 'class="bs-example form-horizontal"'); ?>
                <h4>Po ceni</h4>

                <div class="row">

                    <div class="col-md-1">
                        <label  class="control-label">Od:</label>
                    </div>
                    <div class="col-md-5">

                        <input type="text" class="form-control" name="cenaOD" data-validation="number" >
                    </div>

                    <div class="col-md-5">

                        <input type="text" class="form-control" name="cenaDO" data-validation="number" >
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-4">
                    </div>

                    <div class="col-lg-4">
                        <button class="btn btn-success" type="submit">Prikazi </button>
                    </div>
                </div>
                <?php echo form_close(); ?> </td>

                <hr>
                <?php echo form_open_multipart("katalog/prikazi_poZanru", 'class="bs-example form-horizontal"'); ?>

                <h4>Po žanru</h4>

                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="form-group">

                        <div class="col-lg-8">
                            <select class="form-control" name="zanrSelect">
                                <option value="Avantura">Avantura</option>
                                <option value="Drama">Drama</option>
                                <option value="Fantastika">Fantastika</option>
                                <option value="Krimi">Kriminalistički</option>
                                <option value="Misterija">Misterija</option>
                            </select>


                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                    </div>

                    <div class="col-lg-4">
                        <button class="btn btn-info" type="submit">Prikazi </button>
                    </div>
                </div>
                
                <?php echo form_close(); ?> </td>
                <hr>
                <?php echo form_open_multipart("katalog/prikazi_katalogValute", 'class="bs-example form-horizontal"'); ?>
                <h4>Po valuti</h4>

                <div class="row">
                    <div class="col-md-1">
                    </div>
                    <div class="form-group">

                        <div class="col-lg-8">
                            <select class="form-control" name="valuta">
                                <option value="2">Evro</option>
                                <option value="1">Dinar</option>

                            </select>


                        </div>
                    </div>

                </div>


                

                <div class="row">
                    <div class="col-md-4">
                    </div>

                    <div class="col-lg-4">
                        <button class="btn btn-info" type="submit">Preračunaj </button>
                    </div>
                    <?php echo form_close(); ?> </td>
                </div>
            </div>
            </ul>
 </div>


