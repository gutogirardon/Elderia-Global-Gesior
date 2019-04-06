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
<form target="pagseguro" method="post" action="">
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
<tr bgcolor="#d4c0a1">
<td><b>PayPal Shop System</b><br /><br />
Preços da Loja:
<ul><li> 1 Real (1 Tibia Coins)</li></ul>
<br />
<b>Aqui estão os passos que você precisa fazer:</b> <br />
1. Uma conta do PayPal com com saldo necessário ou um cartao de credito. <br />
2. Preencha os campos necessarios<br />
3. Clique no botão Comprar agora ou na marca do seu cartão de crédito. <br />
4. Finalize a transaçao. <br />
5. Após a operação os Tibia Coins será automaticamente adicionado à sua conta. <br />
6. Vá ate a loja e use seus coins. <br /> <br /> <br />

<span style="color:red">Nao faça transaçao indevida voce perderá seus pontos e sua conta sera deletada.</span>
<br />
<br /></td></tr>
</tbody></table>
<table border="0" cellpadding="4" cellspacing="1" width="100%" id="#estilo"><tbody>
<tr bgcolor="#505050" class="white">

</tr>

<tr bgcolor="#d4c0a1">
<td width="10%">Banco</td>
<td><strong>ITAU</strong></td>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Agencia</td>
<td><strong>0273</strong></td>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Conta</td>
<td><strong>08544-9</strong></td>
</tr>
<tr bgcolor="#d4c0a1">
<td width="10%">Favorecido</td>
<td><strong>Wanderson Gomes Barbosa</strong></td>
</tr>
</tr>
</tbody></table></form>
<br>
<center>Para receber os Tibia Coins envie um email para <b>fullprojectibia@gmail.com</b> com nome do <u>Char/Data/Comprovante</u> de preferencia imagem.</center>
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
				<td width="5%"><img src="/images/items/2358.gif"></td><td><b>Premium Soft Boots (20 Tibia Coins)</b><br>(Faster regeneration, Boh speed, infinita).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/12649.gif"></td><td><b>Blade of Corruption (4 Tibia Coins)</b><br>(Attack: 48. Defense: 29 +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/2160.gif"></td><td><b>100 crystal coins (4 Tibia Coins)</b><br>(1kk direto para seu personagem).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/8927.gif"></td><td><b>Dark Trinity Mace (5 Tibia Coins)</b><br>(Attack: 51. Defense: 32 -1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/2494.gif"></td><td><b>Demon Armor (4 Tibia Coins)</b><br>(Armo:16).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/2495.gif"></td><td><b>Demon Legs (4 Tibia Coins)</b><br>(Armo: 9).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/15410.gif"></td><td><b>Depth Calcei (8 Tibia Coins)</b><br>(Armo:3, protection physical +5%, speed -5).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/15408.gif"></td><td><b>Depth Galea (8 Tibia Coins)</b><br>(Armo:8, protection drown +100%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/15407.gif"></td><td><b>Depth Lorica (8 Tibia Coins)</b><br>(Armo:16, distance fighting +3, protection death +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/15409.gif"></td><td><b>Depth Ocrea (8 Tibia Coins)</b><br>(Armo:8, protection mana drain +15%).</td><td>!item "nome</td>
			</tr>		
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/15411.gif"></td><td><b>Depth Scutum (6 Tibia Coins)</b><br>(Defense:25, magic level +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/2472.gif"></td><td><b>Magic Plate Armor (5 Tibia Coins)</b><br>(Armo:17).</td><td>!item "nome</td>
			</tr>	
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/8884.gif"></td><td><b>Oceanborn Leviathan Armor (5 Tibia Coins)</b><br>(Arm:15, shielding +1, protection energy -5%, ice +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/12645.gif"></td><td><b>Elite Draken Helmet (4 Tibia Coins)</b><br>(Arm:9, distance fighting +1, protection death +3%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/2646.gif"></td><td><b>Golden Boots (4 Tibia Coins)</b><br>(Armo:4).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/2471.gif"></td><td><b>Golden Helmet (8 Tibia Coins)</b><br>(Armo:12).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/12642.gif"></td><td><b>Royal Draken Mail (4 Tibia Coins)</b><br>(Armo:16, shielding +3, protection physical +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/12643.gif"></td><td><b>Royal Scale Robe (4 Tibia Coins)</b><br>(Arm:12, magic level +2, protection fire +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/18465.gif"></td><td><b>Shiny Blade (5 Tibia Coins)</b><br> (Attack:50, Defense:35 +3, sword fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/8882.gif"></td><td><b>Earthborn Titan Armor (5 Tibia Coins)</b><br>(Armo:15, axe fighting +2, protection earth +5%, fire -5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/8883.gif"></td><td><b>Windborn Colossus Armor (5 Tibia Coins)</b><br>(Armo:15, club fighting +2, protection energy +5%, earth -5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/8881.gif"></td><td><b>Fireborn Giant Armor (5 Tibia Coins)</b><br>(Armo:15, sword fighting +2, protection fire +5%, ice -5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/6132.gif"></td><td><b>Soft Boots (7 Tibia Coins)</b><br>(Pair of soft boots).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/18451.gif"></td><td><b>Crystalline Axe (5 Tibia Coins)</b><br>(Attack:51, Defense:29 +3, axe fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/8888.gif"></td><td><b>Master Archers Armor (5 Tibia Coins)</b><br>(Armo:15, distance fighting +3)).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/18452.gif"></td><td><b>Mycological Mace (5 Tibia Coins)</b><br> (Attack:50, Defense:31 +3, club fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/2361.gif"></td><td><b>Frozen Starlight (4 Tibia Coins)</b><br>(See a frozen starlight).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/8851.gif"></td><td><b>Royal Crossbow (5 Tibia Coins)</b><br>(Range:6, Atk+5, Hit%+3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22398.gif"></td><td><b>Crude Umbral Blade (6 Tibia Coins)</b><br>(Attack:48, Def:26 +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22399.gif"></td><td><b>Umbral Blade (14 Tibia Coins)</b><br>(Attack:50, Def:29 +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22400.gif"></td><td><b>Umbral Masterblade (20 Tibia Coins)</b><br>(Attack:52, Defense:31 +3, sword fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22401.gif"></td><td><b>Crude Umbral Slayer (10 Tibia Coins)</b><br>(Attack:51, Def:29).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22402.gif"></td><td><b>Umbral Slayer (10 Tibia Coins)</b><br>(Attack:52, Def:31).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22403.gif"></td><td><b>Umbral Master Slayer (16 Tibia Coins)</b><br>(Attack:54, Defense:35, sword fighting +3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22404.gif"></td><td><b>Crude Umbral Axe (10 Tibia Coins)</b><br>(Attack:49, Def:24).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22405.gif"></td><td><b>Umbral Axe (14 Tibia Coins)</b><br>(Attack:51, Def:27 +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22406.gif"></td><td><b>Umbral Master Axe (20 Tibia Coins)</b><br>(Attack:53, Defense:30 +3, axe fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22407.gif"></td><td><b>Crude Umbral Chopper (6 Tibia Coins)</b><br>(Attack:51, Defense:27).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22408.gif"></td><td><b>Umbral Chopper (10 Tibia Coins)</b><br>(Attack:52, Def:30).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22409.gif"></td><td><b>Umbral Master Chopper (16 Tibia Coins)</b><br>(Attack:54, Defense:34, axe fighting +3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22410.gif"></td><td><b>Crude Umbral Mace (10 Tibia Coins)</b><br>(Attack:48, Defense:22 +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22411.gif"></td><td><b>Umbral Mace (14 Tibia Coins)</b><br>(Attack:50, Defense:26 +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22412.gif"></td><td><b>Umbral Master Mace (20 Tibia Coins)</b><br>(Attack:52, Defense:30 +3, club fighting +1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22413.gif"></td><td><b>Crude Umbral Hammer (6 Tibia Coins)</b><br>(Attack:51, Defense:27).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22414.gif"></td><td><b>Umbral Hammer (10 Tibia Coins)</b><br>(Attack:53, Defense:30).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22415.gif"></td><td><b>Umbral Master Hammer (16 Tibia Coins)</b><br>(Attack:55, Defense:34, club fighting +3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22416.gif"></td><td><b>Crude Umbral Bow (6 Tibia Coins)</b><br>(Range:7, Attack+2, Hit%+5).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22417.gif"></td><td><b>Umbral Bow (10 Tibia Coins)</b><br>(Range:7, Attack+4, Hit%+5).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22418.gif"></td><td><b>Umbral Master Bow (20 Tibia Coins)</b><br>(Range:7, Attack+6, Hit%+5).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22419.gif"></td><td><b>Crude Umbral Crossbow (6 Tibia Coins)</b><br>(Range:5, Attack+3, Hit%+3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22420.gif"></td><td><b>Umbral Crossbow (10 Tibia Coins)</b><br>(Range:5, Attack+6, Hit%+3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22421.gif"></td><td><b>Umbral Master Crossbow (20 Tibia Coins)</b><br>(Range:5, Attack+9, Hit%+4).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22422.gif"></td><td><b>Crude Umbral Spellbook (6 Tibia Coins)</b><br>(Def:14, magic level +1, energy+2%, earth+2%, fire+2%, ice+2%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/22423.gif"></td><td><b>Umbral Spellbook (10 Tibia Coins)</b><br> (Def:16, magic level +2, energy+3%, earth+3%, fire+3%, ice+3%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/22424.gif"></td><td><b>Umbral Master Spellbook (20 Tibia Coins)</b><br>(Def:20, magic level +4, energy+5%, earth+5%, fire+5%, ice+5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/16112.gif"></td><td><b>Spellbook of Ancient Arcana (7 Tibia Coins)</b><br>(Defense:19, magic level +4, protection death +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/8918.gif"></td><td><b>Spellbook of Dark Mysteries (5 Tibia Coins)</b><br>(Defense:16, magic level +3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/16111.gif"></td><td><b>Thorn Spitter (7 Tibia Coins)</b><br>(Range:6, Attack+9, Hit%+1).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/9778.gif"></td><td><b>Yalahari Mask (4 Tibia Coins)</b><br>(Armo:5, magic level +2).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/9776.gif"></td><td><b>Yalahari Armor (4 Tibia Coins)</b><br>(Armo:16, protection death +3%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/9777.gif"></td><td><b>Yalahari Leg Piece (4 Tibia Coins)</b><br>(Armo:8, distance fighting +2, protection death +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/2504.gif"></td><td><b>Dwarven Legs (8 Tibia Coins)</b><br>(Armo:7, protection physical +3%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/2503.gif"></td><td><b>Dwarven Armor (8 Tibia Coins)</b><br>(Armo:10, protection physical +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/12644.gif"></td><td><b>Shield of Corruption (5 Tibia Coins)</b><br>(Defense:36, sword fighting +3).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/15413.gif"></td><td><b>Ornate Shield (4 Tibia Coins)</b><br>(Defense:36, protection physical +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/6391.gif"></td><td><b>Nightmare Shieldr (5 Tibia Coins)</b><br>(Defense:37).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/6433.gif"></td><td><b>Necromancer Shield (6 Tibia Coins)</b><br>(Defense:37).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/18410.gif"></td><td><b>Prismatic Shield (6 Tibia Coins)</b><br>(Defense:37, shielding +2, protection physical +4%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/21725.gif"></td><td><b>Furious Frock (4 Tibia Coins)</b><br>(Armo:12, magic level +2, protection fire +5%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/12544.gif"></td><td><b>Stamina Potion (10 Tibia Coins)</b><br>Restaura toda sua Stamina.</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/15406.gif"></td><td><b>Ornate Chestplate (10 Tibia Coins)</b><br>(Arm:16, shielding +3, protection physical +8%).</td><td>!item "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/15412.gif"></td><td><b>Ornate Legs (8 Tibia Coins)</b><br>(Arm:8, protection physical +5%).</td><td>!item "nome</td>
			</tr>			
		</table>

<?php } ?>'; } ?>