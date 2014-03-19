<div class="container"><!-- sadrzi glavni deo sajta meni i sadrzaj-->
 <div class="row">

  <div class="col-md-3">
        
        <div class="list-group">
        <a href="<?php echo site_url('auth/index'); ?>" class="list-group-item">Pocetna  </a>
       <?php if ($this->ion_auth->is_admin()): ?>
        <a href="<?php echo site_url('admin/show_user'); ?>" class="list-group-item">Kreiranje korisnika</a>
         <a href="<?php echo site_url('admin/prikazi_uploadSlike'); ?>" class="list-group-item">Dodavanje knjige</a>
          <a href="<?php echo site_url('admin/prikazi_sveKorisnike'); ?>" class="list-group-item">Spisak korisnika </a>
        <?php endif; ?>
         
          <a href="<?php echo site_url('user/prikaziKatalog'); ?>" class="list-group-item">Katalog knjiga</a>
        

        </div>
      </div>