<?PHP
if($logged) {

if ($action == '') {

$main_content .= '<img id="ContentBoxHeadline" class="Title" src="images/head/buychar.png" alt="Contentbox headline">
<h3>Welcome to our characters shop<br><small style="font-weight: normal; font-size: 11px;">Here you can sell or buy characters using Tibia Coins, to play on our server.</small><br><small style="font-weight: normal; font-size: 11px;"><b>PS.</b> For your <b><font color="green">safety</font></b>, when you complete the purchase, the <i><b>old nickname will be deleted from all vip lists</b></i> when they (players that have the characters name on the vip list) relog.</small></h3>

<div class="SmallBox">
			<div class="MessageContainer">
				<div class="BoxFrameHorizontal" style="background-image:url(./layouts/tibiacom/images/content/box-frame-horizontal.gif);"></div>
				<div class="BoxFrameEdgeLeftTop" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);"></div>
				<div class="BoxFrameEdgeRightTop" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);"></div>
				<div class="Message">
					<div class="BoxFrameVerticalLeft" style="background-image:url(./layouts/tibiacom/images/content/box-frame-vertical.gif);"></div>
					<div class="BoxFrameVerticalRight" style="background-image:url(./layouts/tibiacom/images/content/box-frame-vertical.gif);"></div>
					<table class="HintBox">
						<tbody>
							<tr>
								<td><i><small>If you want to sell your characters make login on your account. If no character is shown it means that your account does not have characters allowed for sale.<br>Rules to sell:<br><br></small></i><ul><i><small><li>You can not be online.</li><li>You can not belong to any guild.</li><li>Your account can not be banned.</li><li>Your character must be at least <strong>level 150</strong>.</li>
								<li>You need pay a <strong>1</strong>% of fee related to the sale price.</li>
								</small></i></ul></td>											
							</tr>	
						</tbody>
					</table>
				</div>
				<div class="BoxFrameHorizontal" style="background-image:url(./layouts/tibiacom/images/content/box-frame-horizontal.gif);"></div>
				<div class="BoxFrameEdgeRightBottom" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);"></div>
				<div class="BoxFrameEdgeLeftBottom" style="background-image:url(./layouts/tibiacom/images/content/box-frame-edge.gif);"></div>
			</div>
		</div> ';		
$main_content .= '<p>Below is a list of the characters available for sale.</p>';


$main_content .= '<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=4 WIDTH=100%><TR BGCOLOR='.$config['site']['vdarkborder'].'><TD CLASS=white width="64px"><CENTER><B></B></CENTER></TD><TD CLASS=white width="80px"><CENTER><B>Name</B></CENTER></TD><TD CLASS=white width="64px"><CENTER><B>Vocation</B></CENTER></TD><TD CLASS=white width="40px"><CENTER><B>Level</B></CENTER></TD><TD CLASS=white width="40px"><CENTER><B>Coins</B></CENTER></TD><TD CLASS=white width="64px"><CENTER><B>Continue to buy</B></CENTER></TD></TR>';

$getall = $SQL->query('SELECT `id`, `name`, `price`, `status` FROM `sellchar` ORDER BY `id`')or die(mysql_error());

foreach ($getall as $tt) {
$namer = $tt['name'];
$queryt = $SQL->query("SELECT `name`, `vocation`, `level`, `looktype`, `lookaddons`, `lookhead`, `lookbody`, `looklegs`, `lookfeet` FROM `players` WHERE `name` = '$namer'");
foreach ($queryt as $ty) {
if ($ty['vocation'] == 1) {
$tu = 'Sorcerer';
} else if ($ty['vocation'] == 2) {
$tu = 'Druid'; 
} else if ($ty['vocation'] == 3) {
$tu = 'Paladin'; 
} else if ($ty['vocation'] == 4) {
$tu = 'Knight';
} else if ($ty['vocation'] == 5) {
$tu = 'Sorcerer';
} else if ($ty['vocation'] == 6) {
$tu = 'Druid'; 
} else if ($ty['vocation'] == 7) {
$tu = 'Paladin'; 
} else if ($ty['vocation'] == 8) {
$tu = 'Knight';
}
$ee = $tt['name'];
$ii = $tt['price'];

//inserir aqui o tdd do outfit

$main_content .= '<TR BGCOLOR='.$config['site']['darkborder'].'>

	<TD height="64px" style="position:relative;"><span style="display:block; position:absolute; top:-15px; left:-10px;"><img src="http://outfit-images.ots.me/animatedOutfits1090/animoutfit.php?id='.$ty['looktype'].'&addons='.$ty['lookaddons'].'&head='.$ty['lookhead'].'&body='.$ty['lookbody'].'&legs='.$ty['looklegs'].'&feet='.$ty['lookfeet'].'"> </span><br/></TD>
	
	<TD CLASS=black width="64px"><CENTER><B><a href="index.php?subtopic=characters&name='.$tt['name'].'">'.$tt['name'].'</a></B></CENTER></TD>
	<TD CLASS=black width="64px"><CENTER><B>'.$tu.'</B></CENTER></TD>
	<TD CLASS=black width="64px"><CENTER><B>'.$ty['level'].'</B></CENTER></TD>
	<TD CLASS=black width="64px"><CENTER><B>'.$tt['price'].'</B></CENTER></TD>

	<td>
   <center>
      <form id="myform" name="myform" action="?subtopic=buychar&action=buy" method="post" style="padding:0px;margin:0px;">
         <div class="BigButton" style="background-image:url(./layouts/tibiacom/images/buttons/sbutton_green.gif)">
            <input type="hidden" name="char" value="'.$ee.'">
			<input type="hidden" name="price" value="'.$ii.'">
			<input class="ButtonText" name="Buy" alt="Continue" src="./layouts/tibiacom/images/vips/_sbutton_continue.gif" type="image">
         </div>         
      </form>
   </center>
	</td>
	</TR>
	</form>


';

}
}
$main_content .= '</TABLE>';

}

if ($action == 'buy') {

$name = $_POST['char'];
$price = $_POST['price'];
$ceh = $SQL->query("SELECT `name` FROM `sellchar` WHERE `name` = '$name'");

if ($ceh) {

if ($name == '') {

$main_content .= '<b><center>Select a character to buy first/b>';

} else {

$user_premium_points = $account_logged->getCustomField('coins');
$user_id = $account_logged->getCustomField('id');

if ($user_premium_points >= $price) {

$check = $SQL->query("SELECT * FROM `sellchar` WHERE `name` = '$name'") or die(mysql_error());
$check1 = $SQL->query("SELECT * FROM `players` WHERE `name` = '$name'") or die(mysql_error());
$check2 = $SQL->query("SELECT `oldid` FROM `sellchar` WHERE `name` = '$name'");
foreach ($check as $result) {
foreach($check1 as $res) {
foreach($check2 as $ress) {

$oid = $ress['oldid'];
$main_content .= '<center>You bought<b> '.$name.' ( '.$res['level'].' ) </b>for <b>'.$result['price'].' points.</b><br></center>';
$main_content .= '<br>';
$main_content .= '<center><b>The character is in your account, have fun!</b></center>';
$execute1 = $SQL->query("UPDATE `accounts` SET `coins` = `coins` - '$price' WHERE `id` = '$user_id'");
$execute2 = $SQL->query("UPDATE `players` SET `account_id` = '$user_id' WHERE `name` = '$name'");
$execute2 = $SQL->query("UPDATE `accounts` SET `coins` = `coins` + '$price' WHERE `id` = '$oid'");
$execute3 = $SQL->query("DELETE FROM `sellchar` WHERE `name` = '$name'");

}
}
}

} else {

$main_content .= '<center><b>Você não tem tibia coins suficientes.</b></center>^<br>
<center><b>You dont have tibia coins.</b></center>';

}

} 

} else {
$main_content .= '<center><b>Este char não pode mais ser comprado.</b></center>';
}
}

} else {
//pagina para nao logados
$main_content .= '<div class="sellinfo">
			<i class="fas fa-bullhorn"></i> Você está deslogado!<br> <a href="?subtopic=accountmanagement">Clique aqui</a> para entrar em sua conta para comprar um personagem.
		</div>'
		;
}
?>