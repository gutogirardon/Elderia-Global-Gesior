<?php
if(!defined('INITIALIZED'))
    exit;

$orderby = 'name';
if(isset($_REQUEST['order']))
{
    if($_REQUEST['order']== 'level')
        $orderby = 'level';
    elseif($_REQUEST['order'] == 'vocation')
        $orderby = 'vocation';
}
$players_online_data = $SQL->query('SELECT ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('flag') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('vocation') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('level') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('skull') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looktype') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookaddons') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookhead') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookbody') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('looklegs') . ', ' . $SQL->tableName('players') . '.' . $SQL->fieldName('lookfeet') . ' FROM ' . $SQL->tableName('accounts') . ', ' . $SQL->tableName('players') . ', ' . $SQL->tableName('players_online') . ' WHERE ' . $SQL->tableName('players') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('players_online') . '.' . $SQL->fieldName('player_id') . ' AND ' . $SQL->tableName('accounts') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('players') . '.' . $SQL->fieldName('account_id') . ' ORDER BY ' . $SQL->fieldName($orderby))->fetchAll();
$number_of_players_online = 0;
$vocations_online_count = array(0,0,0,0,0); // change it if you got more then 5 vocations
$players_rows = '';
foreach($players_online_data as $player)
{
    $bgcolor = (($number_of_players_online++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
}
if($number_of_players_online == 0)
{
    //server status - server empty
    $main_content .= '';
}
else
{

}
?>
<?php
if(!defined('INITIALIZED'))
  exit;
?>

<head>
  <title><?PHP echo $title ?> Alternative Tibia Server</title>
  <meta name="description" content="<?PHP echo $title ?> Servidor Global de Tibia - Versão 11!" />
  <meta name="author" content="Gesior" />
  <meta http-equiv="content-language" content="en" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <meta name="keywords" content="Globalzera, Servidor de otserv,Servidor de tibia, jogo gratis, jogo legal, free online game, free multiplayer game, free online rpg, free mmorpg, mmorpg, mmog, online role playing game, online multiplayer game, internet game, online rpg, rpg,tibia, br, tibiabr, downloads, magias, magic, brasil, tibiabrasil, macetes, tibiarpgbrasil, dicas, tibiagg, mapas, rpg, graphical mud, rpg, game, fantasy, medieval, roleplaying game, mmorpg, massively multiplayer, online game, persistent online game, online world, persistent online world, massively multi-user, massively multi user, multi-user-dungeon, multiuser dungeon, internet game, online spiel, internet spiel, rollenspiel, multiplayer spiel, multiplayer game, free game, kostenloses spiel, free internet game, free online game, Página Inicial" />
  <link rel="shortcut icon" href="<?PHP echo $layout_name; ?>/images/server.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />

      <script>
        var loginStatus=0;
        loginStatus='<?php if($logged){ ?>true<?php } else { ?>false<?php } ?>';
        <?php if ($_REQUEST['subtopic'] == 'accountmanagement' && $_REQUEST['action'] == 'donate'){?>
        var activeSubmenuItem='donate';
        <?php }else{?>
        var activeSubmenuItem='<?php echo $subtopic; ?>';
        <?php }?>
        var JS_DIR_IMAGES=0;
        JS_DIR_IMAGES='<?php echo $layout_name; ?>/images/';
        var JS_DIR_ACCOUNT=0;
        JS_DIR_ACCOUNT='';
        var g_FormName='';
        var g_FormField='';
        var g_Deactivated=false;
        var g_FlashClientInPopUp= true;
    </script>

  <?PHP echo $layout_header; ?>
  <link href="<?PHP echo $layout_name; ?>/basic.css" rel="stylesheet" type="text/css">
  <script type='text/javascript'> var IMAGES=0; IMAGES='<?PHP echo $layout_name; ?>/images'; var g_FormField='';  var LINK_ACCOUNT=0; LINK_ACCOUNT='';</script>

  <script type="text/javascript" src="<?PHP echo $layout_name; ?>/initialize.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
 <style type="text/css">
body,input
    {
    font-family:"Trebuchet ms",arial;font-size:0.9em;
    color:#333;
    }
.spoiler
    {
    border:0px solid #ddd;
    padding:0px;
    }
.spoiler .inner
    {
    border:0px solid #eee;
    padding:3px;margin:3px;
    }
    </style>
    <script type="text/javascript">
function showSpoiler(obj)
    {
    var inner = obj.parentNode.getElementsByTagName("div")[0];
    if (inner.style.display == "none")
        inner.style.display = "";
    else
        inner.style.display = "none";
    }
    </script>
 
 <script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnload&render=explicit' async defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
//<!--
$(document).ready(function() {$(".floatinglikebox").hover(function() {$(this).stop().animate({right: "0"}, "medium");}, function() {$(this).stop().animate({right: "-250"}, "medium");}, 500);});
//-->
</script>
<style type="text/css">
.floatinglikebox{
background: url(<?PHP echo $layout_name; ?>/images/facebook.png) no-repeat scroll left center transparent !important;
display:block;float:right;
height:220px;padding:0 5px 0 40px;
width:245px;z-index:99999;
position:fixed;right:-250px;
top:160px;}
.floatinglikebox div{border:none;position:relative;display:block;}
.floatinglikebox span{bottom:10px;font:11px tahoma,verdana,arial,sans-serif;
position:absolute;right:6px;text-align:right;z-index:99999;}
.floatinglikebox span a{color:#808080;text-decoration:none;}
.floatinglikebox span a:hover{text-decoration:underline;}
</style><div class="floatinglikebox" style="">
<div>
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Ffacebook.com%2FElderia-Global-1644718452501589&
width=251&height=231&colorscheme=light&show_faces=true&
border_color=%23fffff&stream=false&header=false&" scrolling="no" frameborder="0" style="border:none;overflow:hidden;width:251px;height:231px;background:#fff;" allowtransparency="true">
</iframe><span></span>
</div></div>
</head>
<body onBeforeUnLoad="SaveMenu();" onUnload="SaveMenu();">

<script>
  var _captchaTries = 0;
function recaptchaOnload() {
    _captchaTries++;
    if (_captchaTries > 9)
        return;
    if ($('.g-recaptcha').length > 0) {
        grecaptcha.render("recaptcha", {
            sitekey: '6Lckn44UAAAAAEnLYBWGQF7Iyf_SPWgxo2dK5f9X',
            callback: function() {
                console.log('recaptcha callback');
            }
        });
        return;
    }
    window.setTimeout(recaptchaOnload, 1000);
}
</script>
 
<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?PHP echo $layout_name; ?>/shop.js"></script>
<a name="top"></a>
<div id="HeaderArtworkDiv" style="background-image:url(<?PHP echo $layout_name; ?>/images/header/background-artwork.jpg);"></div>
<div id="Bodycontainer">
<div id="ContentRow">
<div id="MenuColumn">
<div id="LeftArtwork">
<img src="<?PHP echo $layout_name; ?>/images/header/tibia-logo-art.png" alt="logoartwork" name="TibiaLogoArtworkTop" id="TibiaLogoArtworkTop" onClick="window.location = 'index.php?subtopic=latestnews';" />

</div>

<div id="Loginbox">
  <div id="LoginTop" style="background-image:url(./layouts/tibiacom/images/general/box-top.gif)"></div>
  <div id="BorderLeft" class="LoginBorder" style="background-image:url(./layouts/tibiacom/images/general/chain.gif)"></div>
  <div id="LoginButtonContainer" style="background-image:url(./layouts/tibiacom/images/loginbox/loginbox-textfield-background.gif)">
  <div id="PlayNowContainer"><form class="MediumButtonForm" action="?subtopic=accountmanagement" method="post"><input type="hidden" name="page" value="overview"><div class="MediumButtonBackground" style="background-image:url(./layouts/tibiacom/images/buttons/mediumbutton.gif)" onmouseover="MouseOverMediumButton(this);" onmouseout="MouseOutMediumButton(this);"><div class="MediumButtonOver" style="background-image: url(&quot;./layouts/tibiacom/images/buttons/mediumbutton-over.gif&quot;); visibility: hidden;" onmouseover="MouseOverMediumButton(this);" onmouseout="MouseOutMediumButton(this);"></div><input class="MediumButtonText" type="image" name="Play Now" alt="Play Now" src="./layouts/tibiacom/images/buttons/mediumbutton_myaccount.png"></div></form></div>
  </div>
  <div class="Loginstatus" style="background-image:url(./layouts/tibiacom/images/loginbox/loginbox-textfield-background.gif)">
  <div id="LoginstatusText_1" onclick="LoginstatusTextAction(this);" onmouseover="MouseOverLoginBoxText(this);" onmouseout="MouseOutLoginBoxText(this);"><div id="LoginstatusText_1_1" name="LoginstatusText_1" class="LoginstatusText" style="background-image: url(&quot;./layouts/tibiacom/images/loginbox/loginbox-font-logout.gif&quot;); visibility: visible;"></div><div id="LoginstatusText_2" class="LoginstatusText" style="background-image: url(&quot;./layouts/tibiacom/images/loginbox/loginbox-font-logout-over.gif&quot;); visibility: hidden;"></div></div>        <div id="ButtonText"></div>
  </div>
  <div id="BorderRight" class="LoginBorder" style="background-image:url(./layouts/tibiacom/images/general/chain.gif)"></div>
  <div id="LoginBottom" class="Loginstatus" style="background-image:url(./layouts/tibiacom/images/general/box-bottom.gif)"></div>
  </div>
<div id='Menu'>
<div id='MenuTop' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/box-top.gif);'></div>
<div id='news' class='menuitem'>
<span onClick="MenuItemAction('news')">
  <div class='MenuButton' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/button-background-over.gif);'></div>
      <span id='news_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/green-light.gif);'></div>
      </span>
      <div id='news_Icon' class='Icon' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/icon-news.gif);'></div>
      <div id='news_Label' class='Label' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/label-news.gif);'></div>
      <div id='news_Extend' class='Extend' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/plus.gif);'></div>
    </div>
  </div>
</span>
<div id='news_Submenu' class='Submenu'>
<a href='index.php?subtopic=latestnews'>
  <div id='submenu_latestnews' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_latestnews' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Latest News</div>
    <div class='RightChain' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=archive'>
  <div id='submenu_archive' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_archive' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>News Archive</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=castsystem'>
  <div id='submenu_castsystem' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_archive' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Cast System</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
</div>
</div>

<div id='account' class='menuitem'>
<span onClick="MenuItemAction('account')">
  <div class='MenuButton' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background-over.gif);'></div>
      <span id='account_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
      </span>
      <div id='account_Icon' class='Icon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-account.gif);'></div>
      <div id='account_Label' class='Label' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/label-account.gif);'></div>
      <div id='account_Extend' class='Extend' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/plus.gif);'></div>
    </div>
  </div>
</span>
<div id='account_Submenu' class='Submenu'>
<a href='?subtopic=accountmanagement'>
  <div id='submenu_accountmanagement' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_accountmanagement' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Account Management</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=createaccount'>
  <div id='submenu_createaccount' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_createaccount' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Create Account</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=downloads'>
  <div id='submenu_downloads' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_downloads' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Downloads</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=lostaccount'>
  <div id='submenu_lostaccount' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_lostaccount' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Lost Account?</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<?PHP
if($config['site']['download_page'])
echo "<a href='?subtopic=download'>
  <div id='submenu_download' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_download' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Downloads</div>
    <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
  </div>
</a>";
?>
</div>
</div>

<!-- war sub menu -->
<div id='warmenu' class='menuitem'>
<span onClick="MenuItemAction('warmenu')">
  <div class='MenuButton' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background-over.gif);'></div>
      <span id='warmenu_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
      </span>
      <div id='library_Icon' class='Icon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-wars.gif);'></div>
      <div id='library_Label' class='Label' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/label-wars.gif);'></div>
      <div id='library_Extend' class='Extend' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/plus.gif);'></div>
    </div>
  </div>
</span>
<div id='warmenu_Submenu' class='Submenu'>

<a href='index.php?subtopic=wars'>
  <div id='submenu_wars' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/chain.gif);'></div>

    <div id='ActiveSubmenuItemIcon_wars' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel' style="color: red;">War System</div>
    <div class='RightChain' style='background-image:url(<?PHP echo "$layout_name"; ?>/images/general/chain.gif);'></div>
  </div>
</a>

<a href='?subtopic=fraggers'>
  <div id='submenu_fraggers' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_fraggers' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Top Fraggers</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>

<a href='?subtopic=killstatistics'>
  <div id='submenu_killstatistics' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_killstatistics' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Last Kills</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
</div>
</div>
<!-- fim war sub menu -->


<div id='community' class='menuitem'>
<span onClick="MenuItemAction('community')">
  <div class='MenuButton' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background-over.gif);'></div>
      <span id='community_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
      </span>
      <div id='community_Icon' class='Icon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-community.gif);'></div>
      <div id='community_Label' class='Label' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/label-community.gif);'></div>
      <div id='community_Extend' class='Extend' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/plus.gif);'></div>

    </div>
  </div>
</span>
<div id='community_Submenu' class='Submenu'>
<a href='?subtopic=characters'>
  <div id='submenu_characters' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_characters' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Characters</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<?php 
echo "<a href='?subtopic=buychar'>
  <div id='submenu_sellchar' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_sellchar' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><span style='color:yellow'><i class='fa fa-shopping-cart' aria-hidden='true'></i> Trade Characters</span></div>
    <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
  </div>
</a>";
 ?>

<a href='?subtopic=whoisonline'>
  <div id='submenu_whoisonline' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_whoisonline' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Who Is Online?</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=highscores'>
  <div id='submenu_highscores' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_highscores' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Highscores</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=houses'>
  <div id='submenu_houses' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_houses' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Houses</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=guilds'>
  <div id='submenu_guilds' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>

    <div id='ActiveSubmenuItemIcon_guilds' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Guilds</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=team'>
  <div id='submenu_team' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_team' class='ActiveSubmenuItemIcon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Support List</div>
    <div class='RightChain' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/chain.gif);'></div>
  </div>
</a>
</div>
</div>

<?PHP
echo "<div id='forum' class='menuitem'>
         <span onClick=\"MenuItemAction('forum')\">
   <div class='MenuButton' style='background-image:url(".$layout_name."/images/menu/button-background.gif);'>
       <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(".$layout_name."/images/menu/button-background-over.gif);'></div>
               <span id='forum_Lights' class='Lights'>
                <div class='light_lu' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
                <div class='light_ld' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
                <div class='light_ru' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
               </span>
               <div id='forum_Icon' class='Icon' style='background-image:url(".$layout_name."/images/menu/icon-forum.gif);'></div>
               <div id='forum_Label' class='Label' style='background-image:url(".$layout_name."/images/menu/label-forum.gif);'></div>
               <div id='forum_Extend' class='Extend' style='background-image:url(".$layout_name."/images/general/plus.gif);'></div>
             </div>
           </div>
          </span>
       <div id='forum_Submenu' class='Submenu'>
          <a href='?subtopic=forum'>
           <div id='submenu_forum' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
             <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
             <div id='ActiveSubmenuItemIcon_forum' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
             <div class='SubmenuitemLabel'>Server Forum</div>
             <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
           </div>
          </a>
        </div>
       </div>";
?>



<div id='library' class='menuitem'>
<span onClick="MenuItemAction('library')">
  <div class='MenuButton' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/button-background-over.gif);'></div>
      <span id='library_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/green-light.gif);'></div>
      </span>
      <div id='library_Icon' class='Icon' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/icon-library.gif);'></div>
      <div id='library_Label' class='Label' style='background-image:url(<?PHP echo $layout_name; ?>/images/menu/label-library.gif);'></div>
      <div id='library_Extend' class='Extend' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/plus.gif);'></div>
    </div>
  </div>
</span>
<div id='library_Submenu' class='Submenu'>
<?PHP
if($config['site']['serverinfo_page'])
echo "<a href='?subtopic=serverinfo'>
  <div id='submenu_serverinfo' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_serverinfo' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Server Info</div>
    <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
  </div>
</a>";
?>
<a href='?subtopic=raids'>
  <div id='submenu_raids' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_raids' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Raids</font></div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
<!-- <a href='?subtopic=reward'>
  <div id='submenu_reward' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_reward' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><font color="yellow">Reward System</font></div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a> -->
<!-- <a href='?subtopic=umbral'>
  <div id='submenu_umbral' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_umbral' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Umbral Creation</div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a> -->
</div>
</div>

<!-- Eventos retirados -->
<!-- <div id='events' class='menuitem'>
<span onClick="MenuItemAction('events')">
  <div class='MenuButton' style='background-image:url(./layouts/tibiacom/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(./layouts/tibiacom/images/menu/button-background-over.gif);'></div>
      <span id='events_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(./layouts/tibiacom/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(./layouts/tibiacom/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(./layouts/tibiacom/images/menu/green-light.gif);'></div>
      </span>
      <div id='events_Icon' class='Icon' style='background-image:url(./layouts/tibiacom/images/menu/bicon-events.gif);'></div>
      <div id='events_Label' class='Label' style='background-image:url(./layouts/tibiacom/images/menu/label-events.gif);'></div>
      <div id='events_Extend' class='Extend' style='background-image:url(./layouts/tibiacom/images/general/plus.gif);'></div>
    
  </div>
  </div>
</span>
<div id='events_Submenu' class='Submenu'>
<a href='?subtopic=battlefield'>
  <div id='submenu_battlefield' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_battlefield' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><font color="White">Battlefield</font></div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=laststandindevent'>
  <div id='submenu_laststandindevent' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_battlefield' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><font color="White">Last Standing Event</font> </div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=capturetheflag'>
  <div id='submenu_capturetheflag' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_CapturetheFlag' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><font color="White">Capture the Flag</font></div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=zombie'>
  <div id='submenu_zombie' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_battlefield' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><font color="White">Zombie</font> </div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
<a href='?subtopic=eventshop'>
  <div id='submenu_eventshop' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_eventshop' class='ActiveSubmenuItemIcon' style='background-image:url(./layouts/tibiacom/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'>Events Shop</div>
    <div class='RightChain' style='background-image:url(./layouts/tibiacom/images/general/chain.gif);'></div>
  </div>
</a>
</div>
</div> -->

<?PHP
if($config['site']['shop_system'])
{
echo "<div id='shops' class='menuitem'>
<span onClick=\"MenuItemAction('shops')\">
  <div class='MenuButton' style='background-image:url(".$layout_name."/images/menu/button-background.gif);'>
    <div onMouseOver='MouseOverMenuItem(this);' onMouseOut='MouseOutMenuItem(this);'><div class='Button' style='background-image:url(".$layout_name."/images/menu/button-background-over.gif);'></div>
      <span id='shops_Lights' class='Lights'>
        <div class='light_lu' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
        <div class='light_ld' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
        <div class='light_ru' style='background-image:url(".$layout_name."/images/menu/green-light.gif);'></div>
      </span>
      <div id='shops_Icon' class='Icon' style='background-image:url(".$layout_name."/images/menu/icon-shops.gif);'></div>
      <div id='shops_Label' class='Label' style='background-image:url(".$layout_name."/images/menu/label-shops.gif);'></div>
      <div id='shops_Extend' class='Extend' style='background-image:url(".$layout_name."/images/general/plus.gif);'></div>
    </div>
  </div>
</span>
</div>
<div id='shops_Submenu' class='Submenu'>
<a href='?subtopic=buypoints'>
  <div id='submenu_buypoints' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
    <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
    <div id='ActiveSubmenuItemIcon_buypoints' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
    <div class='SubmenuitemLabel'><div style=\"color: yellow;\">Donate - Coins</div></div>
    <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
  </div>
</a>
";
//Painel adicionar coins pelo admin com acesso - desativado por enquanto
// if($group_id_of_acc_logged >= $config['site']['access_admin_panel'])
// echo "<a href='?subtopic=shopadmin'>
//   <div id='submenu_shopadmin' class='Submenuitem' onMouseOver='MouseOverSubmenuItem(this)' onMouseOut='MouseOutSubmenuItem(this)'>
//     <div class='LeftChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
//     <div id='ActiveSubmenuItemIcon_shopadmin' class='ActiveSubmenuItemIcon' style='background-image:url(".$layout_name."/images/menu/icon-activesubmenu.gif);'></div>
//     <div class='SubmenuitemLabel'><font color=red>! Edit/Remove/Add !</font></div>
//     <div class='RightChain' style='background-image:url(".$layout_name."/images/general/chain.gif);'></div>
//   </div>
// </a>";
echo "</div>";
}
?>
<div id='MenuBottom' style='background-image:url(<?PHP echo $layout_name; ?>/images/general/box-bottom.gif);'></div>
</div>
  <script type='text/javascript'>InitializePage();</script></div>
        <div id="ContentColumn">
          <div class="Content">
            <div id="ContentHelper">

              <div id="" class="Box">
<div class="Corner-tl" style="background-image:url(./layouts/tibiacom/images/content/corner-tl.gif);"></div>
<div class="Corner-tr" style="background-image:url(./layouts/tibiacom/images/content/corner-tr.gif);"></div>
<div class="Border_1" style="background-image:url(./layouts/tibiacom/images/content/border-1.gif);"></div>
<div class="BorderTitleText" style="background-image:url(./layouts/tibiacom/images/content/newsheadline_background.gif); height: 28px;">
<div class="InfoBar">
&nbsp;
<a class="InfoBarBlock" style="text-decoration:none" href="?subtopic=castsystem">
<img class="InfoBarBigLogo" src="./layouts/tibiacom/images/icon-cast.png">
<!-- <span class="InfoBarNumbers"><img class="InfoBarSmallElement" src="./layouts/tibiacom/images/icon-streamers.png">
<span class="InfoBarSmallElement">177</span>
<img class="InfoBarSmallElement" src="./layouts/tibiacom/images/icon-viewers.png">
<span class="InfoBarSmallElement">13</span> -->
</span>
</a>    

<a style="text-decoration:none" href="https://www.youtube.com/results?search_query=elderia+global&amp;page=&amp;utm_source=opensearch" target="_blank">
<img class="InfoBarBigLogo" src="./layouts/tibiacom/images/icon-youtube.png">
</a>

</div>
</div>
<div class="Border_1" style="background-image:url(./layouts/tibiacom/images/content/border-1.gif);">
</div>
<div class="CornerWrapper-b">
<div class="Corner-bl" style="background-image:url(./layouts/tibiacom/images/content/corner-bl.gif);"></div>
</div>
<div class="CornerWrapper-b"><div class="Corner-br" style="background-image:url(./layouts/tibiacom/images/content/corner-br.gif);">
</div>
</div>
</div>
      <script type="text/javascript" src="<?PHP echo "$layout_name"; ?>/newsticker.js"></script>
      <?PHP echo "$news_content"; ?>
    <div id="<?PHP echo $subtopic; ?>" class="Box">
    <div class="Corner-tl" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/corner-tl.gif);"></div>
    <div class="Corner-tr" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/corner-tr.gif);"></div>
    <div class="Border_1" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/border-1.gif);"></div>
    <div class="BorderTitleText" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/title-background-green.gif);"></div>
  <img id="ContentBoxHeadline" class="Title" src="pages/headline.php?txt=<?PHP echo ucwords(str_replace('_', ' ', strtolower($subtopic))); ?>" alt="Contentbox headline">
    <div class="Border_2">
      <div class="Border_3">
        <div class="BoxContent" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/scroll.gif);">
  <?PHP echo $main_content; ?>
      </div>
      </div>
    </div>
    <div class="Border_1" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/border-1.gif);"></div>

    <div class="CornerWrapper-b"><div class="Corner-bl" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/corner-bl.gif);"></div></div>
    <div class="CornerWrapper-b"><div class="Corner-br" style="background-image:url(<?PHP echo $layout_name; ?>/images/content/corner-br.gif);"></div></div>
  </div>
           </div>
          </div>
<div id="Footer">
Layout created by <b>CipSoft GmbH </b> and Edited By Guto</a><br />
All rights reserveds
</div>
</div>
<div id="ThemeboxesColumn">
<div id="RightArtwork">
<img id="Monster" src="layouts/tibiacom/images/gaz.gif"  ';" />
<img id="PedestalAndOnline" src="<?PHP echo "$layout_name"; ?>/images/header/pedestal-and-online.gif" alt="Monster Pedestal and Players Online Box"/>
<?PHP
if(count($config['site']['worlds']) > 1)
$whoisonlineworld = 'index.php?subtopic=whoisonline';
else
$whoisonlineworld = 'index.php?subtopic=whoisonline&world=0';
?>
<div id="PlayersOnline" onClick="window.location='<?PHP echo "$whoisonlineworld"; ?>'">
          <?PHP
            if($config['status']['serverStatus_online'] == 0)
                echo ''.$number_of_players_online.'<br />Players Online';                
            else
                echo '<font color="red"><b>Server<br />OFFLINE</b></font>';
          ?></div>
        </div>
<div id="Themeboxes">
<?php
$skills = $SQL->query('SELECT * FROM players WHERE deleted = 0 AND group_id = 1 AND account_id != 1 ORDER BY level DESC LIMIT 5');
?>
<style type="text/css" media="all">
  .Toplevelbox {
    top: -4px;
    position: relative;
    margin-bottom: 10px;
    width: 180px;
    height: 200px;
  }
  .top_level {
    position: absolute;
    top: 29px;
    left: 6px;
    height: 160px;
    width: 168px;
    z-index: 20;
    text-align: center;
    padding-top: 6px;
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 9.2pt;
    color: #FFF;
    font-weight: bold;
    text-align: right;
    text-decoration: inherit;
    text-shadow: 0.1em 0.1em #333
  }
  #Topbar a {
  text-decoration: none;
  cursor: auto;
  }
  a.topfont {
    font-family: Verdana, Arial, Helvetica;
    font-size: 11px;
        color: #00FF00;
    text-decoration: none
  }
  a:hover.topfont {
    font-family: Verdana, Arial, Helvetica;
    font-size: 11px;
    color: #CCC;
    text-decoration:none
  }
</style>
<div id="Topbar" class="Toplevelbox" style="background-image:url(<?PHP echo $layout_name; ?>/images/themeboxes/top_level.png);">
  <div class="top_level" style="background:url(<?PHP echo $layout_name; ?>/images/themeboxes/bg_top.png)" align=" ">
    <?php
    $a = 1;
    foreach($skills as $skill) {
      echo '<div align="left"><a href="?subtopic=characters&name='.$skill['name'].'" class="topfont">
        <font color="#CCC">&nbsp;&nbsp;&nbsp;&nbsp;'.$a.' - </font>'.$skill['name'].'
        <br>
        <small><font color="white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level: ('.$skill['level'].')</font></small>
        <br>
      </a>
      </div>';
      $a++;
    }
    ?>
    <div class="Bottom" style="background-image:url(<?PHP echo $layout_name; ?>/images/general/box-bottom.gif); top: 159px;; left:-5px;">
  </div>
</div>
</div>
<!-- premium theme box -->
  <div id="Themeboxes">
  <div id="PremiumBox" class="Themebox" style="background-image:url(<?PHP echo "$layout_name"; ?>/images/themeboxes/premiumbox.gif);">
   <div class="ThemeboxButton" onClick="BigButtonAction('index.php?subtopic=store')" onMouseOver="MouseOverBigButton(this);" onMouseOut="MouseOutBigButton(this);" style="background-image:url(<?PHP echo "$layout_name"; ?>/images/buttons/sbutton_green.gif);"><div class="BigButtonOver" style="background-image:url(<?PHP echo "$layout_name"; ?>/images/buttons/sbutton_green_over.gif);"></div>
   <div class="ButtonText" style="background-image:url(<?PHP echo "$layout_name"; ?>/images/buttons/_sbutton_getpremium.gif);"></div>
   </div>
  <div class="Bottom" style="background-image:url(<?PHP echo "$layout_name"; ?>/images/general/box-bottom.gif);"></div>
  </div>
        </div>
      </div>
     </div>
    </div>
  </div>

<div id="float_discord_plugin" style="visibility: visible; width: 300px; height: 500px; position: fixed; top: 55px; right: -300px; background-color: rgb(33, 33, 39); border-radius: 30px; z-index: 2147483647;"><a target="_blank" rel="noopener noreferrer" href="https://discord.gg/P7V36Nu">
<img src="./layouts/tibiacom/images/discord.png" style="cursor:pointer;position:absolute;margin-left:-34px;bottom:0px;" border="0"></a>
</div>


</body>
</html>
