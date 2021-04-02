<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content=""/> 
	<meta name="keywords" content="">
    <title><?php echo $pagetitle;?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/login/ladda-themeless.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/login/spin.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/login/ladda.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
	 
  <script type="text/javascript">
    $(function () {
        $(".form-signin").on('submit',function(){
            $(".resultlogin").html("<div class='alert alert-success loading '>Please Wait...</div>");
            $.post("<?php echo base_url().$this->uri->segment(1);?>dashboard/login",$(".form-signin").serialize(), function(response){
            var resp = $.parseJSON(response);
            console.log(resp);
            if(!resp.status){
            $(".resultlogin").html("<div class='alert alert-danger loading '>"+resp.msg+"</div>");
            }else{
            $(".resultlogin").html("<div class='alert alert-success login '>Please Wait...</div>").delay(20000);
            window.location.replace(resp.url);
            }
            }); 
        });

        $(".form-signup").on('submit',function(){
            $(".resultregister").html("<div class='alert alert-success loading '>Please Wait...</div>");
            $.post("<?php echo base_url().$this->uri->segment(1);?>dashboard/signup",$(".form-signup").serialize(), function(response){
            var resp = $.parseJSON(response);
            console.log(resp);
            if(!resp.status){
            $(".resultregister").html("<div class='alert alert-danger loading '>"+resp.msg+"</div>");
            }else{
            $(".resultregister").html("<div class='alert alert-success login '>Success, Login first...</div>");
            window.location.replace(resp.url);
            }
            }); 
        });
    
     });
  </script>

</head>
    <body>
        <?php echo $_content; ?>
        
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="application/javascript">

            new WOW().init();
            $(function () {
			$("#menu").popover({
                html : true,
                placement: 'bottom',
			});
		})	
        </script>

    </body>
</html>