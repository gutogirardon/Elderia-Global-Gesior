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
				<td width="5%"><img src="/images/items/76.gif"></td><td><b>Barbarian (15 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/77.gif"></td><td><b>Warrior (15 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/78.gif"></td><td><b>Assassin (15 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/79.gif"></td><td><b>Insectoid (15 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/87.gif"></td><td><b>Summoner (20 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/88.gif"></td><td><b>Red Baron (20 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/285.gif"></td><td><b>Halloween (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/126.gif"></td><td><b>Glooth Engineer (20 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/127.gif"></td><td><b>Champion (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/128.gif"></td><td><b>Conjurer (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/129.gif"></td><td><b>Beastmaster (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/223.gif"></td><td><b>Chaos Acolyte (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/224.gif"></td><td><b>Death Herald (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/225.gif"></td><td><b>Ranger (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/226.gif"></td><td><b>Ceremonial Garb (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/227.gif"></td><td><b>Marionette Puppeteer (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/228.gif"></td><td><b>Spirit Caller (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/281.gif"></td><td><b>Evoker (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/282.gif"></td><td><b>Seaweaver (40 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['lightborder'].'">
				<td width="5%"><img src="/images/items/283.gif"></td><td><b>Recruiter (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
			<tr bgcolor="'.$config['site']['darkborder'].'">
				<td width="5%"><img src="/images/items/284.gif"></td><td><b>Pirate (50 Tibia Coins)</b><br>(Voce recebera o addon male e female full no jogo).</td><td>!addon "nome</td>
			</tr>
		</table>
<?php } ?>'; } ?>