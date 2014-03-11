<div class="container"><!-- sadrzi glavni deo sajta meni i sadrzaj-->
 <div class="row">

  <div class="col-md-3">
        
        <div class="list-group">
        <a href="<?php echo site_url('auth/index'); ?>" class="list-group-item">Pocetna  </a>
       <?php if ($this->ion_auth->is_admin()): ?>
        <a href="<?php echo site_url('user/show_user'); ?>" class="list-group-item">Kreiranje korisnika</a>
         <a href="<?php echo site_url('user/show_register'); ?>" class="list-group-item">Dodavanje knjige</a>
          <a href="<?php echo site_url('admin/prikazi_sveKorisnike'); ?>" class="list-group-item">Spisak korisnika </a>
        <?php endif; ?>
         
          <a href="#" class="list-group-item">Spisak knjiga</a>
        

        </div>
      </div>