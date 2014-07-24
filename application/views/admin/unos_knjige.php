<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="well">



                <?php echo form_open_multipart("admin/unesi_knjigu", 'class="bs-example form-horizontal"'); ?>
                <fieldset>
                    <legend>Unos nove knjige </legend>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"> Naziv:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="naziv" data-validation="length" data-validation-length="min3" placeholder="Naziv knjige...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" >Autor:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="autor" data-validation="length" data-validation-length="min4" placeholder="Autor knjige...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Zanr:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="zanr" data-validation="length" data-validation-length="min3" placeholder="Zanr...">
                        </div>                
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="godina">Godina izdanje:</label>

                        <div class="col-lg-10">
                            <input type="text"  class="form-control" name="godina_izdanja" data-validation="custom" data-validation-regexp="^(19|20)\d{2}$" placeholder="Godina...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="izdavac">Izdavac:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="izdavac" data-validation="length" data-validation-length="min3" placeholder="Izdavac...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label"  >Opis:</label>

                        <div class="col-lg-10">
                            <textarea class="form-control" name="opis" id="textArea" data-validation="length" data-validation-length="min10" placeholder="Kratak opis knjige..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" >Broj strana:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="br_strana" placeholder="Broj strana..." data-validation="number" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" >Cena:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="cena" placeholder="Cena knjige..." data-validation="number" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" >Kolicina:</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="kolicina" placeholder="Kolicina knjige..." data-validation="number" >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="panel panel-default" id="panel">
                            <div class="panel-heading" id="panelHead">Izaberite sliku za datu knjigu:</div>
                            <div class="panel-body" id="dropbox">


                                <input type="file" id="userfile" name="userfile" accept="image/*" style="display:none" onchange="handleFiles(this.files)">
                                <a href="#" id="fileSelect">Izaberite sliku  za upload, ili prevucite sliku u polje</a> 
                                <div id="fileList">


                                    <h1 id="nemaSlike"><i class=" glyphicon glyphicon-picture"></i> <?php
                                        if (!empty($data)) {
                                            foreach ($data as $d) {
                                                echo $d;             # code...
                                            }
                                        }
                                        ?></h1> 

                                </div>
                                <div class="alert alert-dismissable alert-warning" id="poruka">
                                    <button type="button" class="close" id="closeMessage" >×</button>
                                    Mozete uneti samo jednu sliku za datu knjigu
                                </div>
                            </div>
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


        </div>
    </div>  
    <script type="text/javascript">
        window.URL = window.URL || window.webkitURL;
        document.getElementById("poruka").style.display = "none";

        var fileSelect = document.getElementById("fileSelect"),
                fileElem = document.getElementById("userfile"),
                fileList = document.getElementById("fileList");
        var dropbox;

        dropbox = document.getElementById("dropbox");
        dropbox.addEventListener("dragenter", dragenter, false);
        dropbox.addEventListener("dragover", dragover, false);
        dropbox.addEventListener("drop", drop, false);

        fileSelect.addEventListener("click", function(e) {
            if (fileElem) {
                fileElem.click();



            }
            e.preventDefault(); // prevent navigation to "#"
        }, false);

        function handleFiles(files) {
            if (!files.length) {
                fileList.innerHTML = "<p>Niste selektovali sliku!</p>";
            } else {
                var list = document.createElement("ul");
                    var li = document.createElement("li");
                    list.appendChild(li);

                    var img = document.createElement("img");
                    img.src = window.URL.createObjectURL(files[i]);
                    img.height = 150;
                    img.onload = function(e) {
                        window.URL.revokeObjectURL(this.src);
                    }
                    li.appendChild(img);

                    var info = document.createElement("span");
                    info.innerHTML = files[i].name + ": " + Math.round(files[i].size / 1024) + " kb";
                    document.getElementById("panel").className = "panel panel-success";
                    document.getElementById("nemaSlike").style.display = "none";
                    document.getElementById("fileSelect").style.display = "none";
                    document.getElementById("dropbox").removeEventListener("dragenter", dragenter);
                    document.getElementById("dropbox").removeEventListener("drop", drop);
                    document.getElementById("poruka").style.display = "block";



                fileList.appendChild(list);
                //      fileSelect.removeEventListener("click", function(e));

                ;
            }
        }
        function dragenter(e) {
            e.stopPropagation();
            e.preventDefault();
        }

        function dragover(e) {
            e.stopPropagation();
            e.preventDefault();


        }


        function drop(e) {
            e.stopPropagation();
            e.preventDefault();

            var dt = e.dataTransfer;
            var files = dt.files;

            handleFiles(files);

        }
    </script>         




