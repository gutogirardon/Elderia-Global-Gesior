<?php
if(!$logged)
if($action == "logout")
$main_content .= '<div class="TableContainer" > <table class="Table1" cellpadding="0" cellspacing="0" > <div class="CaptionContainer" > <div class="CaptionInnerContainer" > <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span> <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span> <div class="Text" >Logout Successful</div> <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span> <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span> <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> </div> </div> <tr> <td> <div class="InnerTableContainer" > <table style="width:100%;" ><tr><td>You have logged out of your '.$config['server']['serverName'].' account. In order to view your account you need to <a href="?subtopic=accountmanagement" >log in</a> again.</td></tr> </table> </div> </table></div></td></tr>';
else
$main_content .= 'Please enter your account name and your password.<br/><a href="?subtopic=createaccount" >Create an account</a> if you do not have one yet.<br/><br/><form action="?subtopic=accountmanagement" method="post" ><div class="TableContainer" > <table class="Table1" cellpadding="0" cellspacing="0" > <div class="CaptionContainer" > <div class="CaptionInnerContainer" > <span class="CaptionEdgeLeftTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightTop" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionBorderTop" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span> <span class="CaptionVerticalLeft" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span> <div class="Text" >Account Login</div> <span class="CaptionVerticalRight" style="background-image:url('.$layout_name.'/images/content/box-frame-vertical.gif);" /></span> <span class="CaptionBorderBottom" style="background-image:url('.$layout_name.'/images/content/table-headline-border.gif);" ></span> <span class="CaptionEdgeLeftBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> <span class="CaptionEdgeRightBottom" style="background-image:url('.$layout_name.'/images/content/box-frame-edge.gif);" /></span> </div> </div> <tr> <td> <div class="InnerTableContainer" > <table style="width:100%;" ><tr><td class="LabelV" ><span >Account Name:</span></td><td style="width:100%;" ><input type="password" name="account_login" SIZE="10" maxlength="10" ></td></tr><tr><td class="LabelV" ><span >Password:</span></td><td><input type="password" name="password_login" size="30" maxlength="29" ></td></tr> </table> </div> </table></div></td></tr><br/><table width="100%" ><tr align="center" ><td><table border="0" cellspacing="0" cellpadding="0" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div &#111;nmouseover="MouseOverBigButton(this);" &#111;nmouseout="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Submit" alt="Submit" src="'.$layout_name.'/images/buttons/_sbutton_submit.gif" ></div></div></td><tr></form></table></td><td><table border="0" cellspacing="0" cellpadding="0" ><form action="?subtopic=lostaccount" method="post" ><tr><td style="border:0px;" ><div class="BigButton" style="background-image:url('.$layout_name.'/images/buttons/sbutton.gif)" ><div &#111;nmouseover="MouseOverBigButton(this);" &#111;nmouseout="MouseOutBigButton(this);" ><div class="BigButtonOver" style="background-image:url('.$layout_name.'/images/buttons/sbutton_over.gif);" ></div><input class="ButtonText" type="image" name="Account lost?" alt="Account lost?" src="'.$layout_name.'/images/buttons/_sbutton_accountlost.gif" ></div></div></td></tr></form></table></td></tr></table>';
else
{
	$_players = $account_logged->getPlayersList();
	function listaPlayers()
	{
		$_players = $GLOBALS['_players'];
		$o = '<select name="ref_transacao" id="ref_transacao"><option value="">-- Selecione --</option>';
		foreach($_players as $_player)
		{
			$o .= '<option value="'.$_player->getName().'">'.$_player->getName().'</option>';
		}
		$o .= '</select>';

		return $o;
	}

$main_content .= '
<form target="pagseguro" method="post" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
<input type="hidden" name="email_cobranca" value="'. $config['pagseguro']['email']. '">
<input type="hidden" name="tipo" value="CP">
<input type="hidden" name="moeda" value="BRL">
<input type="hidden" name="item_id_1" value="1">
<input type="hidden" name="item_descr_1" value="Pontos na account de nome: '.$account_logged->getCustomField("name").'">
<input type="hidden" name="item_frete_1" value="0">
<input type="hidden" name="item_peso_1" value="0">
<!--<input type="hidden" name="ref_transacao" value="'.$account_logged->getCustomField("name").'">-->
<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td colspan="3"><font class="white"><center><b>Escolha a forma de pagamento</b></center></font></td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td colspan="3"><font class="white"><center><b><center><TABLE BORDER=1>
<TR>
<TD><a href="?subtopic=store">Pagseguro</a></TD>
<TD><a href="?subtopic=storepaypal">Paypal</a></TD>
<TD><a href="?subtopic=storedeposito">Banco ITAU</a></TD>
</TR>
</TABLE><center></b></center></font></td>
			</tr>
</table>
<br>
<table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo"><tbody>
<tr bgcolor="#505050" class="white">
<th colspan="2"><strong>Escolha a quantidade de Tibia Coins que deseja DOAR.</strong></th>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Seu char</td>
<td><strong>'.listaPlayers().'</strong></td>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Sua Conta</td>
<td><strong>'.$account_logged->getCustomField("name").'</strong></td>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Tibia Coins</td>
<td>
<input type="number" ng-model="get_points" min="1" size="5" maxlength="5">
<input name="item_valor_1" type="hidden" value="{{get_points * 100}}" size="5" maxlength="5">
<input name="item_quant_1" type="hidden" value="1" size="1" maxlength="1">
</td>
</tr>
<tr bgcolor="#d4c0a1">
<td colspan="2">
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/carrinhoproprio/btnFinalizar.jpg" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</td>
</tr>
</tbody></table></form>
<br>
<center>Os Tibia Coins são entregues <b>automáticamente</b> logo após a <u>aprovação</u> do seu pagamento pelo PagSeguro.</center>
<br>
<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td colspan="3"><font class="white"><center><b>Shop Offer</b></center></font></td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td colspan="3"><font class="white"><center><b><center><TABLE BORDER=1>
<TR>
<TD><a href="?subtopic=store">Shop Items</a></TD>
<TD><a href="?subtopic=storemounts">Montarias</a></TD>
<TD><a href="?subtopic=storeaddons">Outfits</a></TD>
</TR>
</TABLE><center></b></center></font></td>
			</tr>
</table>
<table border="0" cellpadding="4" cellspacing="1" width="95%">
			<tr bgcolor="'.$config['site']['vdarkborder'].'">
				<td><font class="white"><b>Picture</b></font></td><td><font class="white"><b>Description</b></font></td><td><font class="white"><b>command</b></font></td>
			</tr>		
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/80.gif"></td><td><b>Draptor (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/81.gif"></td><td><b>Dromedary (5 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/82.gif"></td><td><b>Iron Blight (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/83.gif"></td><td><b>Magma Crawler (10 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/84.gif"></td><td><b>Lady Bug (10 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/85.gif"></td><td><b>Scorpion King (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/90.gif"></td><td><b>Shadow Draptor (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/91.gif"></td><td><b>Red Manta (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/92.gif"></td><td><b>Golden Lion (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/93.gif"></td><td><b>War Horse (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/94.gif"></td><td><b>Blazebringer (30 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/95.gif"></td><td><b>Dragonling (15 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/96.gif"></td><td><b>Steelbeak (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/97.gif"></td><td><b>Armoured Scorpion (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/98.gif"></td><td><b>Armoured Cavebear (10 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/99.gif"></td><td><b>Lion (15 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/116.gif"></td><td><b>Walker (10 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/117.gif"></td><td><b>Azudocus (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/118.gif"></td><td><b>Carpacosaurus (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/119.gif"></td><td><b>Death Crawler (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/120.gif"></td><td><b>Flamesteed (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/121.gif"></td><td><b>Jade Lion (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/122.gif"></td><td><b>Jade Pincer (25 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/123.gif"></td><td><b>Nethersteed (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/124.gif"></td><td><b>Tempest (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/125.gif"></td><td><b>Winter King (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/250.gif"></td><td><b>Doombringer (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/251.gif"></td><td><b>Woodland Prince (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/252.gif"></td><td><b>Hailtorm Fury (20 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/253.gif"></td><td><b>Siegebreaker (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/254.gif"></td><td><b>Poisonbane (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/255.gif"></td><td><b>Blackpelt (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/256.gif"></td><td><b>Golden Dragonfly (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/257.gif"></td><td><b>Steel Bee (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/258.gif"></td><td><b>Copper Fly (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/259.gif"></td><td><b>Tundra Rambler (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/260.gif"></td><td><b>Highland Yak (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/261.gif"></td><td><b>Glacier Vagabond (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/262.gif"></td><td><b>Glooth Glider (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/263.gif"></td><td><b>Shadow Hart (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/264.gif"></td><td><b>Black Stag (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/265.gif"></td><td><b>Emperor Deer (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/266.gif"></td><td><b>Flying Divan (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/267.gif"></td><td><b>Magic Carpet (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/268.gif"></td><td><b>Floating Kashmir (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/269.gif"></td><td><b>Ringtail Waccoon (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/270.gif"></td><td><b>Night Waccoon (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/271.gif"></td><td><b>Emerald Waccoon (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/272.gif"></td><td><b>Batcat (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/273.gif"></td><td><b>Flitterkatzen (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/274.gif"></td><td><b>Venompaw (35 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/275.gif"></td><td><b>Coralripper (40 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/276.gif"></td><td><b>Plumfish (40 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/277.gif"></td><td><b>Sea Devil (40 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/278.gif"></td><td><b>Gorongra (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/279.gif"></td><td><b>Noctungra (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/280.gif"></td><td><b>Silverneck (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/286.gif"></td><td><b>Gorlion Scorpion (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/287.gif"></td><td><b>Noctulion Scorpion (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/288.gif"></td><td><b>Silverlion Scorpion (50 Tibia Coins)</b><br>(Voce recebera a montaria no jogo).</td><td>!mount "nome</td>
			</tr>
			</table>
<?php } ?>'; } ?>