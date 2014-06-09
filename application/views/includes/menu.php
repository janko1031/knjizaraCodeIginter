<div class="container"><!-- sadrzi glavni deo sajta meni i sadrzaj-->
 <div class="row">

  <div class="col-md-3">
        <div class="well sidebar-nav">
                        <ul class="nav nav-list" id="sidebar-nav">

                            <li name="top" class="nav-header">Glavni meni</li> 
                            <li name="pocetna"><a href="<?php echo site_url('auth/index'); ?>" > <i class="glyphicon glyphicon-home "></i> Početna </a></li>
                            <li name="katalog"><a href="<?php echo site_url('user/prikaziKatalog'); ?>">Katalog knjiga <i class="glyphicon glyphicon-book pull-right"></i></a></li>
                            <li name="korpa"><a href="<?php echo site_url('user/prikaziKorpu'); ?>">Moja korpa <i class="glyphicon glyphicon-shopping-cart pull-right"> </i>
                            </a></li>
         
          </a></li>
                            <?php if ($this->ion_auth->is_admin()): ?>
                               <li name="top" class="nav-header">Admin deo</li> 
                                    <li name="noviKorisnik"><a href="<?php echo site_url('admin/show_user'); ?>">Dodavanje korisnika <i class=" glyphicon glyphicon-user pull-right"></i>
                                    <i class="glyphicon glyphicon-plus pull-right"></i></a></li>
                                    <li name="NovaKnjiga"><a href="<?php echo base_url('admin/prikazi_unosKnjige'); ?>">Dodavanje knjige <i class="glyphicon glyphicon-book pull-right"></i><i class="glyphicon glyphicon-plus pull-right"></i></a></li> 
                                    <li name="top" class="nav-header ">Prikazi</li>
                                    <li name=""><a href="<?php echo base_url('admin/prikazi_sveKorisnike'); ?>">Administracija korisnika <i class="glyphicon glyphicon-user pull-right"></i></a></li>
                                    <li name="porudzbine"><a href="<?php echo base_url('admin/prikazi_naruceneKnjige'); ?>">Adminstracija proudžbina <i class="glyphicon glyphicon-list-alt pull-right"></i></a></li>
                                    <li name="statistike"><a href="<?php echo base_url('user/prikaziStatistiku'); ?>">Statistike prodaje <i class="glyphicon glyphicon-stats pull-right"></i></a></li>
                                <?php endif; ?>
                    </ul>
                    </div>
     
      </div>
