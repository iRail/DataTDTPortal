<?php
	include_once 'config.php';


        $stats = json_decode(file_get_contents(Config::$url."TDTInfo/Resources.json"));
        //Test whether HttpRequest succeeded


        if(is_object($stats)){

	 $modules = get_object_vars($stats->Resources);

        }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BeRoads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BeRoads data provider website">
    <meta name="author" content="Quentin Kaiser">
    <link rel="shortcut icon" href="img/beroads.ico">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="bootstrap/css/custom.css" rel="stylesheet">

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script>
            $().ready(function() {
                    var $scrollingDiv = $("#scrollingDiv");

                    $(window).scroll(function(){
                            $scrollingDiv
                                    .stop()
                                    .animate({"marginTop": ($(window).scrollTop()) + "px"}, "quick" );
                    });

            });
    </script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->

  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">


         <a class="brand" href=""><?php echo Config::$name; ?></a>
          <div class="nav-collapse">
          </div><!--/.nav-collapse -->
        </div>
      </div>


    </div>

   
    <div class="container">
      <div class="row">

        <div class="span2">
          <div class="well sidebar-nav"  id="scrollingDiv">
            <ul class="nav nav-list" >
              <li class="nav-header">Packages</li>
              <?php
                foreach($modules as $key => $value){
                    if($key!="TDTInfo"){

              ?>
              <li><a href="#<?php echo $key;?>"><?php echo $key; ?></a></li>

               <?php
                }}
               ?>
            </ul>

          </div>

        </div>

        <div class="span10" id="data">
        <?php foreach($modules as $name => $modu){

                if($name !="TDTInfo"){
		?>
                <div id="<?php echo $name; ?>" class="hero-unit">
                <h1><?php echo $name;?></h1><br />
                <?php
                if(is_object($modu)){
                    $resources = get_object_vars($modu);
                    foreach($resources as $resourcename => $resource){
			if($resourcename != "creation_date"){?>
                                <div style="margin-left:3%;text-align: justify;">
				<h3><a href="<?php echo $name."/".$resourcename;?>">
                                <?php echo $resourcename;?></a></h3>
                                <div style="margin-left:3%;text-align: justify;">
                                <p><?php echo $resource->doc; ?></p>

				<?php if(count($resource->requiredparameters) > 0){?>
				<span class="label label-inverse">Required parameters</span>
                                <dl class="dl-horizontal">
				<?php foreach($resource->requiredparameters as $requiredparam){ ?>
					<dt><?php echo $requiredparam;?> </dt>
                                        <dd><?php echo $resource->parameters->$requiredparam;?></dd>
				<?php }} ?>
                                </dl>

                                <?php if(count($resource->parameters) > 0){ ?>
				<span class="label">Optional parameters</span>
                                <dl class="dl-horizontal">
				<?php foreach($resource->parameters as $param => $description){?>

				
						<dt><?php echo $param;?> </dt>
                                                <dd><?php echo $description;?></dd>
			
				<?php }} ?>
                                </dl>
                                </div>
                                </div>
			<?php }
		}?>
                </div>
            <?php


                }}}


                ?>
                <div id="rest_filter" class="hero-unit">
		<h1>REST filtering<small>Because I don't need everything</small></h1>
		<div style="margin-left:3%;text-align: justify;">
		<br />You can filter any resource by going deeper into the directory structure. Adding a /thing/ behind an URL will filter only that thing out of the usual response.
    		<br />Some collections may be filtered to return only entries that match particular conditions. These conditions are specified using filters in the request URI. The following filters are supported, following <a href="http://www.opensearch.org/Home">OpenSearch conventions:</a><br /><br />
	<table class="table table-condensed">
	<tbody>
		<tr>
			<td>filterBy</td>
			<td>&lt;property&gt;</td>
			<td>The name of the property to filter against.</td>
		</tr>
		<tr>
			<td>filterValue</td>
			<td>&lt;value&gt;</td>
			<td>The string to match against the &lt;property&gt; value.</td>
		</tr>
		<tr>
			<td>filterOp</td>
			<td>contains</td>
			<td>Returns all entries where &lt;property&gt; contains &lt;value&gt;.</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>startsWith</td>
			<td>Returns all entries where &lt;property&gt; value begins with &lt;value&gt;.</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>present</td>
			<td>Returns all entries where &lt;property&gt; is defined (&lt;value&gt; is ignored). </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>equals</td>
			<td>Returns all entries where &lt;property&gt; is exactly &lt;value&gt;.</td>
		</tr>

	</tbody>
	</table></div></div>


        </div>

      </div>
      <hr>

      <footer>
        <center><p>&copy; 2011 <a href="http://npo.irail.be" target="_blank">iRail npo</a> - Powered by <a href="http://thedatatank.com" target="_blank">The DataTank</a></p></center>
      </footer>

    </div><!--/.fluid-container-->

    

  </body>
</html>
