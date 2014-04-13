<div class="container"><!-- sadrzi glavni deo sajta meni i sadrzaj-->
 <div class="row">

  <div class="col-md-3">
        
        <div class="list-group">
        <a href="<?php echo site_url('auth/index'); ?>" class="list-group-item">Početna  </a>
       <?php if ($this->ion_auth->is_admin()): ?>
        <a href="<?php echo site_url('admin/show_user'); ?>" class="list-group-item">Kreiranje korisnika</a>
         <a href="<?php echo site_url('admin/prikazi_unosKnjige'); ?>" class="list-group-item">Dodavanje knjige</a>
          <a href="<?php echo site_url('admin/prikazi_sveKorisnike'); ?>" class="list-group-item">Spisak korisnika </a>
           <a href="<?php echo site_url('admin/prikazi_naruceneKnjige'); ?>" class="list-group-item">Naručene knjige</a>
        <?php endif; ?>
         
          <a href="<?php echo site_url('user/prikaziKatalog'); ?>" class="list-group-item">Katalog knjiga</a>
        

        </div>


     <div class="well" >
      <?php echo form_open_multipart("user/prikaziCenu",'class="bs-example form-horizontal"');?>
      <h4>Filter cene</h4>

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
    <hr>
    <div class="row">


     <div class="col-lg-4">
       <button class="btn btn-success" type="submit">Prikazi </button>
     </div>
   </div>
 </form>


</div> 
      </div>