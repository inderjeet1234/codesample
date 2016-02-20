
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Page-Enter" content="blendTrans(Duration=0.2)">
    <meta http-equiv="Page-Exit" content="blendTrans(Duration=0.2)">
    <title>Wednesday Brand Solutions - Project Management Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">







    <link rel="shortcut icon" href="<?php echo base_url();?>css/images/favicon.png">
    <!-- Le styles -->
    <link href="<?php echo base_url();?>js/plugins/chosen/chosen/chosen.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/twitter/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/base.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/lightbox.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
    <script src="<?php echo base_url();?>js/plugins/modernizr.custom.32549.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body <?php if($this->session->userdata('checkcompany')==1  && $this->session->userdata('username')!='manik')
			{?>onLoad="gettime();"<?php
            }?>>
<div id="loading">
    <img src="<?php echo base_url();?>img/ajax-loader.gif">
</div>
<div id="responsive_part">
    <div class="logo">
        <img src="<?php echo base_url();?>img/<?php echo $this->logo; ?>">
    </div>
    <ul class="nav responsive">
        <li>
            <btn class="btn btn-la1rge btn-i1nfo responsive_menu icon_item" data-toggle="collapse" data-target="#sidebar">
                <i class="icon-reorder"></i>
            </btn>
        </li>
    </ul>
</div> <!-- Responsive part -->