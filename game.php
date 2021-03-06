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
    <title></title>
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

    <style>
    input {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      border:1px solid #ccc;
      font-size:20px;
      width:300px;
      min-height:30px;
      display:block;
      margin-bottom:15px;
      margin-top:5px;
      outline: none;

      -webkit-border-radius:5px;
      -moz-border-radius:5px;
      -o-border-radius:5px;
      -ms-border-radius:5px;
      border-radius:5px;
    }
  </style>
    <script src="js/less.js" type="text/javascript"></script>
</head>


<audio id="sound_click">
  <source src="media/click.mp3" type="audio/mp3" />
  <source src="media/click.ogg" type="audio/ogg" />
</audio>

<audio id="sound_open">
  <source src="media/open.mp3" type="audio/mp3" />
  <source src="media/open.ogg" type="audio/ogg" />
</audio>

<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once "downloads/medoo.min-local.php";
$database =  new medoo('macadamia_cluster_02');

// require_once "downloads/medoo.min.php";
// $database =  new medoo('d53482573gb7uf');

$app_id = $_GET["id"];

$app = $database->get("apps", "*", array("id"=>$app_id));

function getShortcuts($database, $app_id) {
    $shortcuts = $database->select("shortcuts", array(
        "shortcuts.id",
        "shortcuts.app_id",
        "shortcuts.name",
        "shortcuts.shortcut",
        "shortcuts.image_url"
    ), array(
        "shortcuts.app_id" => $app_id,
        "ORDER" => "shortcuts.name ASC",
        "LIMIT" => 50
    ));
    return $shortcuts;
}

$high_scores = $database->select("high_scores", array(
        "high_scores.name",
        "high_scores.score"
    ), array(
        "high_scores.app_id" => $app_id,
        "ORDER" => "high_scores.score DESC",
        "LIMIT" => 10
    ));

$shortcuts = getShortcuts($database, $app_id);
?>
<body>
    <div id="container">   
        <section class="container" id="main">       
            <div class="four columns alpha" id="left-col">
                
                <div class="score">
                    <div>
                        <span id="player_score" class="points">0</span> points
                    </div>
                    <div>
                        <span class="scoreStreak">0</span> in a row | <span class="scoreMultiplier">1</span>x multiplier | <span class="percentage">0</span>% correct 
                    </div>
                </div>
                
                <div class="current-software" id="buttons">
                    <img id="application-logo" src="<?php echo $app["image_url"]; ?>">
                    <h2><span id="application-name"><?php echo $app["name"]; ?></span></h2>
                    <button class="button" id="new-game">New Game</button>
                    <button class="button" id="reset">Reset</button>
                    <br>
                    <button class= "button" id ="home" onclick="location.href='http://www.gabymorenocesar.com/ttr/'"> Home</button>


                    <!-- <button class="button" id="home"> <a href= "http://www.gabymorenocesar.com/ttr/">Home</a></button> -->

                    <img id="logo" class="logo-main" src="icons/logo2.png" alt="tut tut revolution logo">
                </div>
                
                <div id="my-modal" class="reveal-modal">
                        <div id= "leaderboard_container">

                             <ul id="leaderboard">
                                <li><a id="leaderboard_title">Name</a></li>
                                <?php                            
                                foreach ($high_scores as $hs):
                                ?>
                                <li><a href=""><?php echo $hs['name']; ?></a></li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                            <ul id="leaderboard">
                                <li><a id="leaderboard_title">Score</a></li>
                                <?php                            
                                foreach ($high_scores as $hs):
                                ?>
                                <li><a href=""><?php echo $hs['score']; ?></a></li>
                                <?php
                                endforeach;
                                ?>

                            </ul>
                        </div>
                    <div id="modal_container">
                        <h1><?php echo $app["name"]; ?></h1>
                        <!-- <img id="logo" class="logo-modal" src="icons/logo.png" alt="tut tut revolution logo"> -->
                        <h2>Select 4 shortcuts you would like to train on..</h2>
                        <div id="icon_holder">  
  
                            <form method="post" action="bin/create-app.php" name="create-shortcut" id="create-shortcut" style = "height: 240px">           
                                <div>
                                    <div class = "textbox_container1"> 
                                        <div class ="text">Name</div>
                                        <br>
                                        <input type="text" id="shortcut_name" name="shortcut_name" class="textbox1" onmouseover = "sound_click.play()" placeholder="Name" value="Test"> 
                                        <br>
                                        <br>
                                    </div> <!-- end .textbox_container1 -->

                                    <div class = "textbox_container1"> 
                                        <div class ="text">Shortcut</div>
                                        <br>
                                        <input type="text" id="shortcut_code" name="shortcut_code" class="textbox short" onmouseover="sound_click.play()"/>
                                        <br>
                                        <br>
                                        <br>
                                        <a id="toggle_modifiers" data-detect="false" href="javascript:toggleModifiers()">Don't detect modifiers</a>
                                    </div> <!-- end .textbox_container1 -->
                                    
                                    <div class = "textbox_container1">    
                                        <div class ="text">Image</div>
                                        <br>
                                        <input type="text" name="shortcut_image_url" class="textbox1" onmouseover = "sound_click.play()" placeholder ="URL" /> 
                                        OR 
                                        <input class = "button" name="shortcut_image" type="file" name="shortcut_image" id="shortcut_image" style ="width: 150px" required/>
                                        <br><br>
                                    </div>
                                    
                                    <div class = "textbox_container1"> 
                                        <div class ="text">Preview Image</div>
                                        <br>
                                        <div id="shortcut_image_preview"></div>

                                        <br><br> 
                                    </div> <!-- end .textbox_container1 -->
                                    <br><br>
                                    
                                    <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">
                                    <a class = "button" href="javascript:createShortcut()" onmouseover = "sound_click.play()" >Create</a>
                                    <a class = "button" href="javascript:hideShortcutModal()" onmouseover = "sound_click.play()" >Cancel</a>
                                </div>
                            </form>
                            <div id="result"></div>

                            
                            <div class="new_shortcut" onmousedown = "sound_open.play()" ></div>

                            <?php                            
                            foreach ($shortcuts as $sc):
                            ?>
                            <div
                                class="icon_selector"
                                id="icon-<?php echo $sc['id']; ?>" 
                                data-id="<?php echo $sc['id']; ?>"
                                data-shortcut="<?php echo $sc['shortcut']; ?>"
                                data-name="<?php echo $sc['name']; ?>"
                                style="background-image:url('<?php echo $sc['image_url']; ?>');">   
                            </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                        
                        
                        <ul class="active-selections">
                            Currently selected tools:
                        </ul>

                        <button class="button" id="start">Start</button>  
                    </div>
                </div>
            </div>

            <div class="twelve columns omega" id="main-col">
                <div class="row" id="top-row">
                    <div id="lifebar">
                        <div id="lifebar-scale"></div>
                    </div>
                </div>
                <div class="row" id="board">
                    <div class="three columns alpha" id="col1-board">
                        <div class="icon-background"></div>
                    </div>
                    <div class="three columns" id="col2-board">
                        <div class="icon-background"></div>
                    </div>
                    <div class="three columns" id="col3-board">
                        <div class="icon-background"></div>
                    </div>
                    <div class="three columns omega" id="col4-board">
                        <div class="icon-background"></div>
                    </div>
                </div>
            </div>
        </section><!-- /main -->        
        <footer>
        </footer><!-- /footer -->
    </div><!--!/#container -->
    <div id="music"></div>
    <!-- !Javascript - at the bottom for fast page loading -->
    <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>!window.jQuery && document.write('<script src=//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><\/script>')</script>
    
    <script src="js/scoring.js"></script>
    <script src="js/keypress.js"></script>
    <script src="js/jquery.reveal.js"></script>
    <script src="js/jquery.jplayer.min.js"></script>
    <script src="js/game.js"></script>
    <script src="js/edit.js"></script>
    
</body>
</html>