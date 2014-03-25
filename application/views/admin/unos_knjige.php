<div class="container">
  <div class="row">

    <div class="col-md-9">
        <div class="well">



           <?php echo form_open_multipart("admin/unesi_knjigu",'class="bs-example form-horizontal"');?>
            <fieldset>
                <legend>Unos nove knjige </legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label"> Naziv:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="naziv" placeholder="Naziv knjige...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" >Autor:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="autor" placeholder="Autor knjige...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Zanr:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="zanr" placeholder="Zanr...">
                    </div>                
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="godina">Godina izdanje:</label>

                    <div class="col-lg-10">
                        <input type="text"  class="form-control" name="godina_izdanja" placeholder="Godina...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="izdavac">Izdavac:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="izdavac" placeholder="Izdavac...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label"  >Opis:</label>

                    <div class="col-lg-10">
                       <textarea class="form-control" name="opis" id="textArea"placeholder="Kratak opis knjige..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label" >Broj strana:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="br_strana" placeholder="Broj strana...">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-lg-2 control-label" >Cena:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="cena" placeholder="Cena knjige...">
                    </div>
                </div>

                  <div class="form-group">
                    <label class="col-lg-2 control-label" >Kolicina:</label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="kolicina" placeholder="Kolicina knjige...">
                    </div>
                </div>

               <div class="form-group">
                     <label class="col-lg-2 control-label" >Izaberite sliku:</label>

                     <div class="col-lg-10" >
                  <input type="file" name="userfile"   /> 
                          <h1><i class=" glyphicon glyphicon-picture"></i> </h1> 
                    </div>
            </div>
                </div>
               
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    
                   <button class="btn btn-success" type="submit">Kreiraj knjigu </button>
                    <a href="<?php echo site_url('auth/index'); ?>" type="button"><button class="btn btn-default">Cancel</button></a>
                </div>
            </div>

           


 


        </fieldset>
    </form>



<!--  <a class="btn btn-warning" style="margin-left: 40px" href="<?php echo site_url('auth/index'); ?>" type="button"> Cancel</a></button>
       -->

</div>
</div>           



