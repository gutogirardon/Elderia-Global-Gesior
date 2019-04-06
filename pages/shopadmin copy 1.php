<style type="text/css">
hr{border:0;border-bottom:1px solid #D4C0A1;padding:3px;}
h1.admshop{margin:0;padding:0;}
label.admshop{float:left;width:100px;}
div.clear{clear:both;}
p.border{border-bottom:1px solid #D4C0A1;padding:3px;}
form input, form select, form button, form reset{padding:3px;}
input.bt{padding:3px 20px;cursor:pointer;}
.success{color:green;}
.error{color:red;}
.bt2{padding:5px 30px;cursor:pointer;}
</style>
<script type="text/javascript">
function _delete(id)
{
	if( confirm('Confirma a exclusão do item selecionado?') )
	{
		location.href='?subtopic=shopadmin&action=delete&id=' + id + '';
	}
	
	return false;
}
</script>
<?php
if(!defined('INITIALIZED'))
	exit;

/*
 * Variável SQL
 */
$SQL = $GLOBALS['SQL'];

if($group_id_of_acc_logged >= $config['site']['access_admin_panel'])
{
	
	/**
	 * Systema By Dezon
	 */
	switch($action)
	{
		case 'list':
			$ofertas = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shop_offer').';');
			
			$result .= '<p><a href="?subtopic=shopadmin">Shop admin</a> | <a href="?subtopic=shopadmin&action=new">Novo</a> | <a href="?subtopic=shopadmin&action=list">Listar</a> | <a href="?subtopic=shopadmin&action=points">Adicionar pontos</a></p>';
			
			$result .= '<TABLE BGCOLOR="#D4C0A1" BORDER="0" CELLPADDING="4" CELLSPACING="1" WIDTH="100%">';
			$result .= '<tr bgcolor="#505050"><td class="white"><strong>Items cadastrados no \'Shop Offer\'</strong></td><tr>';
			
				$result .= '<TABLE BORDER="0" CELLPADDING="2" CELLSPACING="1" WIDTH="100%">';
				$result .= '<TR BGCOLOR="#F1E0C6"><td><strong>ID</strong></td><td><strong>Nome da oferta</strong></td><td><strong>Imagem</strong></td><td><strong>Ações</strong></td></TR>';
				while($data = $ofertas->fetch())
				{
					$result .= '<tr BGCOLOR="#F1E0C6">';
					$result .= '<td>'.$data['id'].'</td>';
					$result .= '<td>'.$data['offer_name'].'</td>';
                                        $result .= '<td align="center"><img src="./images/items/'.$data['itemid1'].$config['site']['item_images_extension'].'" /></td>';
                                        $result .= '<td><a href="?subtopic=shopadmin&action=edit&id='.$data['id'].'">[editar]</a>&nbsp;<a href="javascript:void( _delete('.$data['id'].') );">[excluir]</a></td>';
					$result .= '</tr>';
				}
				$result .= '</table>';
			
			$result .= '</table>';
			
			$main_content .= $result;
			break; //lista as ofertas
		
		case 'edit':
			$main_content .= '<p><a href="?subtopic=shopadmin">Shop admin</a> | <a href="?subtopic=shopadmin&action=new">Novo</a> | <a href="?subtopic=shopadmin&action=list">Listar</a> | <a href="?subtopic=shopadmin&action=points">Adicionar pontos</a></p>';
			$id = is_numeric($_GET['id']) ? $_GET['id'] : header('Location: ?subtopic=shopadmin');
			$dados = $SQL->query('SELECT * FROM '.$SQL->tableName('z_shop_offer').' WHERE id='.$id)->fetch();
			
			if($dados['offer_type'] == 'item')
			{
				$dropdown = '<select name="offer_type"><option value="item" selected="selected">Item</option><option value="item">item</option></select>';
			}
			else if($dados['offer_type'] == 'mounts')
			{
				$dropdown = '<select name="offer_type"><option value="mount" selected="selected">mount</option><option value="mount">mount</option></select>';
			}
                        else if($dados['offer_type'] == 'addons')
			{
				$dropdown = '<select name="offer_type"><option value="addon" selected="selected">addon</option></select>';
			}
			
			$main_content .= <<<EOD
				<h1 class="admshop"><strong>Editar/Atualizar oferta</strong></h1>
				<form method="post" action="?subtopic=shopadmin&action=shop_edit">
					<input type="hidden" name="id_offer" value="{$dados['id']}" />
					<p class="border"><strong>Nome / Descrição da oferta</strong></p>
					<p><label class="admshop">Oferta: </label><input type="text" name="offer_name" size="50" maxlength="100" value="{$dados['offer_name']}" /></p>
					<p><label class="admshop">Descrição: </label><input type="text" name="offer_description" size="50" maxlength="1000" value="{$dados['offer_description']}" /></p>
					<p><label class="admshop">Qtde. pontos: </label><input type="text" name="points" size="5" maxlength="9" value="{$dados['points']}" /></p>
					
					<p class="border"><strong>Tipo da oferta</strong></p>
					<p><label class="admshop">Tipo: </label>{$dropdown}</p>
					
					<p class="border"><strong>Configuração de item normal, armor, shield, legs, etc</strong></p>
					<p><label class="admshop">ID Item 1: </label><input type="text" name="itemid1" size="10" value="{$dados['itemid1']}" /></p>
					<p><label class="admshop">Qtde. Item 1: </label><input type="text" name="count1" size="10" value="{$dados['count1']}" /></p>
					
					<p class="border"><strong>Configuração de item mounts, BP com Runas, BP com Small Stones, etc</strong></p>
					<p><label class="admshop">ID Item 2: </label><input type="text" name="itemid2" size="10" value="{$dados['itemid2']}" /></p>
					<p><label class="admshop">Qtde. Item 2: </label><input type="text" name="count2" size="10" value="{$dados['count2']}" /></p>
					
					<p class="border"><br /></p>
					<input type="submit" value="Salvar edição" class="bt" />
				</form>
				<div class="clear"></div>
EOD;
			break; //edita a oferta selecionada
			
			/******************************************************************************************/
		// Ação responsável por abrir a tela de pontos
		/******************************************************************************************/
		case 'points':
			$main_content .= $items_menu;
			$main_content .= <<<EOD
				<h1 class="admshop"><strong>Adicionar pontos à um Character <small><i>(Char)</i></small></strong></h1>
				<form method="post" action="?subtopic=shopadmin&action=points_add">
					<p class="border"><strong>Entre com o nome do Char</strong></p>
					<p><label class="admshop">Character <small><i>(Char)</i></small>: </label><input type="text" name="char_name" size="30" maxlength="50" /></p>

					<p class="border"><strong>Entre a quantidade de pontos</strong></p>
					<p><label class="admshop">Qtde. pontos: </label><input type="text" name="char_points" size="5" maxlength="9" /></p>

					<p class="border"><br /></p>
					<input type="submit" value="Salvar" class="bt" />
				</form>
				<div class="clear"></div>
EOD;
#/\ Deixe assim !!!
break;
case 'points_add':
			$player = stripslashes(ucwords(strtolower(trim($_POST['char_name']))));
			$points = is_numeric($_POST['char_points']) ? $_POST['char_points'] : 0;

			if(strlen($player) > 0){
				$data   = $SQL->query("SELECT * FROM `players` WHERE `name` = '".$player."';")->fetch();

				if($data['account_id']){
					$SQL->query("UPDATE `accounts` SET `premium_points` = `premium_points` + '".$points."' WHERE `id` = '".$data['account_id']."'");
					$main_content .= '<strong class="success">Pontos adicionados com sucesso à: <i>'.$player.'</i></strong><br /><br /><a href="?subtopic=shopadmin">Voltar</a>';
				}else{
					$main_content .= '<strong class="error">O character indicado não existe.</strong><br /><br /><a href="?subtopic=shopadmin&action=points">Voltar</a>';
				}

				
			}else{
				$main_content .= '<strong class="error">Preencha o nome do Character.</strong><br /><br /><a href="?subtopic=shopadmin&action=points">Voltar</a>';
			}			
			break;
			
		case 'shop_edit':
			$id 				= $_POST['id_offer'];
			$points				= trim($_POST['points']);
			$itemid1			= trim($_POST['itemid1']);
			$count1				= trim($_POST['count1']);
			$itemid2			= trim($_POST['itemid2']);
			$count2				= trim($_POST['count2']);
			$offer_type			= trim($_POST['offer_type']);
			$offer_description	= trim($_POST['offer_description']);
			$offer_name			= trim($_POST['offer_name']);
			
			if(empty($points) && empty($itemid1) && empty($offer_name)) {
				$main_content .= '<strong class="error">Você deve preencher pelo menos os pontos, id item 1 e o nome da oferta!</strong><p><hr /></p><a href="javascript:void(history.go(-1));">Voltar</a>';
			} else {
				$sql_edit = sprintf(
					"UPDATE {$SQL->tableName('z_shop_offer')} SET points=%s, itemid1=%s, count1=%s, itemid2=%s, count2=%s, offer_type='%s', offer_description='%s', offer_name='%s' WHERE id=%s",
					$points,
					$itemid1,
					$count1,
					$itemid2,
					$count2,
					$offer_type,
					$offer_description,
					$offer_name,
					$id
				);
				$SQL->query($sql_edit);
				$main_content .= '<strong class="success">Oferta editada com sucesso!</strong><br /><br /><a href="?subtopic=shopadmin&action=list">Voltar</a>';
			}
			break;
		
		case 'delete':
			$id = is_numeric($_GET['id']) ? $_GET['id'] : header('Location: ?subtopic=shopadmin');
			$SQL->query('DELETE FROM '.$SQL->tableName('z_shop_offer').' WHERE id='.$id);
			header('Location: ?subtopic=shopadmin&action=list');
			break; //exclui items
		
		case 'shop_save':
			$points				= trim($_POST['points']);
			$itemid1			= trim($_POST['itemid1']);
			$count1				= trim($_POST['count1']);
			$itemid2			= trim($_POST['itemid2']);
			$count2				= trim($_POST['count2']);
			$offer_type			= trim($_POST['offer_type']);
			$offer_description	= trim($_POST['offer_description']);
			$offer_name			= trim($_POST['offer_name']);
			
			if(empty($points) && empty($itemid1) && empty($offer_name)) {
				$main_content .= '<strong class="error">Você deve preencher pelo menos os pontos, id item 1 e o nome da oferta!</strong><p><hr /></p><a href="javascript:void(history.go(-1))">Voltar</a>';
			} else {
				$sql_save = sprintf(
					"INSERT INTO `z_shop_offer` (points,itemid1,count1,itemid2,count2,offer_type,offer_description,offer_name)VALUES('%s','%s','%s','%s','%s','%s','%s','%s')",
					(empty($points)  ? 0 : $points),
					(empty($itemid1) ? 0 : $itemid1),
					(empty($count1)  ? 0 : $count1),
					(empty($itemid2) ? 0 : $itemid2),
					(empty($count2)  ? 0 : $count2),
					$offer_type,
					$offer_description,
					$offer_name
				);
				$SQL->query($sql_save);
				$main_content .= '<strong class="success">Oferta salva com sucesso!</strong><br /><br /><a href="?subtopic=shopadmin">Voltar</a>';
			}
			break; //salva a oferta no banco de dados
			
		case 'new':
			$main_content .= '<p><a href="?subtopic=shopadmin">Shop admin</a> | <a href="?subtopic=shopadmin&action=new">Novo</a> | <a href="?subtopic=shopadmin&action=list">Listar</a> | <a href="?subtopic=shopadmin&action=points">Adicionar pontos</a></p>';
			$main_content .= <<<EOD
				<h1 class="admshop"><strong>Cadastrar nova oferta</strong></h1>
				<form method="post" action="?subtopic=shopadmin&action=shop_save">
					<p class="border"><strong>Nome / Descrição da oferta</strong></p>
					<p><label class="admshop">Oferta: </label><input type="text" name="offer_name" size="50" maxlength="100" /></p>
					<p><label class="admshop">Descrição: </label><input type="text" name="offer_description" size="50" maxlength="1000" /></p>
					<p><label class="admshop">Qtde. pontos: </label><input type="text" name="points" size="5" maxlength="9" /></p>
					
					<p class="border"><strong>Tipo da oferta</strong></p>
					<p><label class="admshop">Tipo: </label><select name="offer_type"><option value="item" selected="selected">Item</option><option value="mount">Mounts</option><option value="addon">Addons</option></select></p>
					
					<p class="border"><strong>Configuração de item normal, armor, shield, legs, etc</strong></p>
					<p><label class="admshop">ID Item 1: </label><input type="text" name="itemid1" size="10" /></p>
					<p><label class="admshop">Qtde. Item 1: </label><input type="text" name="count1" size="10" /></p>
					
					<p class="border"><strong>Configuração de item mounts, BP com Runas, BP com Small Stones, etc</strong></p>
					<p><label class="admshop">ID Item 2: </label><input type="text" name="itemid2" size="10" /></p>
					<p><label class="admshop">Qtde. Item 2: </label><input type="text" name="count2" size="10" /></p>
					
					<p class="border"><br /></p>
					<input type="submit" value="Salvar" class="bt" />
				</form>
				<div class="clear"></div>
EOD;
			break; //form de cadastro para nova oferta
		
		default: //Default pois, será por padrão!
			$main_content .= <<<EOD
				<h1 class="admshop"><strong>Bem vindo ao Administrador do Shop!</strong></h1>
				<hr />
				<center>
					<button type="button" class="bt2" onclick="location.href='?subtopic=shopadmin&action=new'">Novo</button>
					<button type="button" class="bt2" onclick="location.href='?subtopic=shopadmin&action=list'">Listar</button>
					<button type="button" class="bt2" onclick="location.href='?subtopic=shopadmin&action=points'">Adicionar Points</button>
				</center>
EOD;
#/\ Deixe assim !!!
			break;
	} 
	//Fim do sistema
	
}
else
{
	$main_content .= 'Sorry, you have not the rights to access this page.';
}

/******************************************************************
* SYSTEMA DE ADMINISTRAÇÃO ONLINE DO WEBSHOP GESIOR 2012 BY DEZON *
*    TODOS OS DIREITOS, POR FAVOR, NÃO REMOVER ESSES CRÉDITOS     *
*       FEITO EXCLUSIVAMENTE PARA O SITE WWW.TIBIAKING.COM        *
******************************************************************/