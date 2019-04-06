<img id="ContentBoxHeadline" class="Title" src="layouts/tibiacom/images/header/headline-team.gif" alt="Contentbox headline">
<?php
if(!defined('INITIALIZED'))
	exit;

$list = $SQL->query('SELECT ' . $SQL->fieldName('name') . ', ' . $SQL->fieldName('id') . ', ' . $SQL->fieldName('group_id') . ' FROM ' . $SQL->tableName('players') . ' WHERE ' . $SQL->fieldName('group_id') . ' IN (' . implode(',', $config['site']['groups_support']) . ') ORDER BY ' . $SQL->fieldName('group_id') . ' DESC');

$main_content .= "<table border=0 cellspacing=1 cellpadding=4 width=100%>
	<td class=\"white\" colspan=\"3\" align=\"center\" bgcolor=\"#505050\"><b>Support Team</b></td>
	 <tr bgcolor=\"#D4C0A1\"><td width=\"100%\"><b>Name</b></td><td><b>Group</b></td></tr>";

foreach($list as $i => $supporter)
{
	$bgcolor = (($i++ % 2 == 1) ?  $config['site']['darkborder'] : $config['site']['lightborder']);
	$main_content .= '<tr bgcolor="'.$bgcolor.'"><td>'.htmlspecialchars($supporter['name']).'</a></td><td>' . htmlspecialchars(Website::getGroupName($supporter['group_id'])) . '</td></tr>';
}

$main_content .= "<br><br>";
$main_content .= "</table>";