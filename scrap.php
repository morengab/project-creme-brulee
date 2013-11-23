<!DOCTYPE html>   
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><![endif]-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Create Shortcuts</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- !CSS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet/less" text="text/css" href="css/normalize.less">
    <link rel="stylesheet/less" text="text/css" href="css/base.less">
    <link rel="stylesheet/less" text="text/css" href="css/icon.less">
    <link rel="stylesheet/less" text="text/css" href="css/eric-test-css.less">
    <link rel="stylesheet/less" text="text/css" href="css/create-app.less">

    <!-- Uncomment if you are specifically targeting less enabled mobile browsers
    <link rel="stylesheet" media="handheld" href="css/handheld.css?v=1">  -->
    <!-- !Modernizr - All other JS at bottom -->
    <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <script src="js/less.js" type="text/javascript"></script>
</head>

<audio id="sound_click">
  <source src="media/click.mp3" type="audio/mp3" />
  <source src="media/click.ogg" type="audio/ogg" />
</audio>

<script type="text/javascript">
    var sound = document.getElementById("sound_click");
    document.getElementById("sound_click").defaultPlaybackRate = 1.5;
</script>

<body>     
    <div class = "container">


        <div class ="create_app_header"> Create Shortcuts </div>
        <br><br>

        <!-- <form method="post" action="create-app.php" name="create_app" id="create_app">
            <label class="create_app_title">App Title</label><br>
            <input type="text" name="name" id="textbox1 app_name" />
            <br><br>
            <label class="create_app_title">Image Url</label><br>
            <input type="text" name="image_url" id="textbox1 app_image_url" />
            <input type="submit" class="browse_button" value="Create App" />
        </form> -->
        <form method="post" action="bin/create-app.php" name="create-app" id="create-shortcut">           
            <div>
                <div class = "textbox_container1"> 
                    <div class ="text"> Shortcut name </div>
                    <br>
                    <input type="text" class="textbox1" onmouseover = "sound_click.play()" placeholder = "Name"> 
                    <br>
                    <br>
                </div> <!-- end .textbox_container1 -->

                <div class = "textbox_container1"> 
                    <div class ="text"> Press shortcut here </div>
                    <br>
                    <input type ="text" class="textbox short" onmouseover = "sound_click.play()" placeholder ="1st key"/>
                    +
                    <input type ="text" class="textbox short" onmouseover = "sound_click.play()" placeholder ="(optional)" />

                    <br><br> 
                </div> <!-- end .textbox_container2 -->

              
                    <div class ="text"> Image URL </div>
                    <br>
                    <input type="text" class="textbox1" onmouseover = "sound_click.play()" /> 
                    <form enctype="multipart/form-data" action="create-app.php" method="POST" id="upload_image"> 
                       <!-- form should be here -->
                    </form>
                    OR 
                    <button class="button" onmouseover="sound_click.play()">Browse</button> 

                    
                    <br><br>
            

            </div>

        </form>

        <div id="result"></div>
   	<br> <br>
    <input type="submit" class="button" onmouseover="sound_click.play()" value="Submit">
    </div> <!-- end .container -->
    

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/edit.js"></script>
</body>