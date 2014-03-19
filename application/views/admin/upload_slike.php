<html>
<head>
<title>Upload Form</title>
</head>
<body>



<?php echo form_open_multipart('admin/uploaduj_sliku');?>


 <input type="file" name="userfile"  />


<br /><br />
   <button class="btn btn-info" type="submit">Uploaduj sliku</button>

</form>

</body>
</html>