<link href="<?PHP echo $layout_name; ?>/shop.css" rel="stylesheet" type="text/css">

<?php
if ($logged) {
    $user_premium_points = $account_logged->getCustomField('premium_points');

    function isInteger($input) {
        return(ctype_digit(strval($input)));
    }

    function getItemByID($id) {
        $id = (int) $id;
        $SQL = $GLOBALS['SQL'];
        $data = $SQL->query('SELECT * FROM ' . $SQL->tableName('z_shop_offer') . ' WHERE ' . $SQL->fieldName('id') . ' = ' . $SQL->quote($id) . ';')->fetch();

        $offer['id'] = $data['id'];
        $offer['type'] = $data['offer_type'];
        $offer['item_id'] = $data['itemid1'];
        $offer['item_count'] = $data['count1'];
        $offer['points'] = $data['points'];
        $offer['description'] = $data['offer_description'];
        $offer['name'] = $data['offer_name'];
        $offer['category'] = $data['offer_category'];
        $offer['new'] = $data['offer_new'];
        $offer['type'] = $data['offer_type'];

        return $offer;
    }

    function getOfferArray() {
        $offer_list = $GLOBALS['SQL']->query('SELECT * FROM ' . $GLOBALS['SQL']->tableName('z_shop_offer') . ' WHERE ' . $GLOBALS['SQL']->fieldName('offer_category') . ' = ' . $_REQUEST['ServiceCategoryID'] . ';');

        $i_item = 0;

        while ($data = $offer_list->fetch()) {
            $offer_array['item'][$i_item]['id'] = $data['id'];
            $offer_array['item'][$i_item]['item_id'] = $data['itemid1'];
            $offer_array['item'][$i_item]['item_count'] = $data['count1'];
            $offer_array['item'][$i_item]['points'] = $data['points'];
            $offer_array['item'][$i_item]['description'] = $data['offer_description'];
            $offer_array['item'][$i_item]['name'] = $data['offer_name'];
            $offer_array['item'][$i_item]['category'] = $data['offer_category'];
            $offer_array['item'][$i_item]['new'] = $data['offer_new'];
            $i_item++;
        }
        return $offer_array;
    }

    if (isset($_REQUEST['ServiceCategoryID'])) {
        $offer_list = getOfferArray();
    } else {
        $_REQUEST['ServiceCategoryID'] = 1;
        $offer_list = getOfferArray();
    }

    if (isset($_REQUEST['ServiceCategoryID']) and empty($_POST['page'])) {
        $main_content .= '


<script type="text/javascript">
	var g_Services = [3,4,5,6,7,8];
	var IMAGES = "./layouts/tibiacom/images/";
	var g_PaymentMethodCategories = {"1":1};
	var g_Prices = {"120":{"11":"30.00 BRL","21":"30.00 BRL","22":"30.00 BRL","31":"30.00 BRL","32":"30.00 BRL","33":"30.00 BRL","40":"30.00 BRL"},"121":{"11":"79.00 BRL","21":"79.00 BRL","22":"79.00 BRL","31":"79.00 BRL","32":"79.00 BRL","33":"79.00 BRL","40":"79.00 BRL"},"122":{"11":"141.00 BRL","21":"141.00 BRL","22":"141.00 BRL","31":"141.00 BRL","32":"141.00 BRL","33":"141.00 BRL","40":"141.00 BRL"},"123":{"11":"246.00 BRL","21":"246.00 BRL","22":"246.00 BRL","31":"246.00 BRL","32":"246.00 BRL","33":"246.00 BRL","40":"246.00 BRL"}};
	var g_QF_Mounts_ServiceCategoryID = 15;
	var g_QF_Outfits_ServiceCategoryID = 17;
	
	function ChangeService(a_ServiceID, a_ServiceCategoryID)
	{
		$(\'#CC_ServiceID\').val(a_ServiceID);
		$(\'#CC_ServiceID\').attr(\'name\', \'InitialServiceID\');
		$(\'#ServiceID_\' + a_ServiceID).attr(\'checked\', \'checked\');
		$(\'.ServiceID_Icon_Container\').css(\'background-color\', \'\');
		if (a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) {
			$(\'.ServiceID_Icon_Animation_1\').hide();
			$(\'.ServiceID_Icon_New_Animation_1\').hide();
			$(\'.ServiceID_Icon_New\').show();
			$(\'#ServiceID_Icon_Animation_1_\' + a_ServiceID).show();
			$(\'#ServiceID_Icon_New_\' + a_ServiceID).hide();
		}
		for (var i = 0; i < g_PaymentMethodCategories.length; i++) {
			if (typeof g_Prices[a_ServiceID] !== \'undefined\') {
				if (typeof g_Prices[a_ServiceID][g_PaymentMethodCategories[i]] === \'undefined\') {
					// deactivate the payment method
					// note: the radio button can not be disabled or we will receive the wrong error message
					$(\'#PMCID_NotAllowed_\' + g_PaymentMethodCategories[i]).show();
					} else {
					// activate the payment method
					$(\'#PMCID_NotAllowed_\' + g_PaymentMethodCategories[i]).hide();
				}
			}
		}
		$(\'.ServiceID_Icon_Selected\').css(\'background-image\', \'\');
		$(\'#ServiceID_Icon_Selected_\' + a_ServiceID).css(\'background-image\', \'url(\' + IMAGES + \'payment/serviceid_icon_selected.png)\');
		return;
	}
	
	// change the selected payment method category
	function ChangePMC(a_PaymentMethodID)
	{
		// set the PMCID for the change country form
		$(\'#CC_PMCID\').val(a_PaymentMethodID);
		$(\'#CC_PMCID\').attr(\'name\', \'InitialPMCID\');
		// activate the radio button
		$(\'#PMCID_\' + a_PaymentMethodID).attr(\'checked\', \'checked\');
		$(\'.PMCID_Icon_Container\').css(\'background-color\', \'\');
		// handle services
		for (var i = 0; i < g_Services.length; i++) {
			if (typeof g_Prices[g_Services[i]] !== \'undefined\') {
				if (typeof g_Prices[g_Services[i]][a_PaymentMethodID] === \'undefined\') {
					// deactivate the service
					// note: the radio button can not be disabled or we will receive the wrong error message
					$(\'#ServiceID_NotAllowed_\' + g_Services[i]).show();
					// set the price
					$(\'#PD_\' + g_Services[i]).html(\'---\');
					} else {
					// activate the service
					// set the price
					$(\'#PD_\' + g_Services[i]).html(g_Prices[g_Services[i]][a_PaymentMethodID]);
					$(\'#ServiceID_NotAllowed_\' + g_Services[i]).hide();
				}
			}
		}
		// activate and mark the selected icon
		$(\'.PMCID_Icon_Selected\').css(\'background-image\', \'\');
		$(\'#PMCID_Icon_Selected_\' + a_PaymentMethodID).css(\'background-image\', url(\'https://cdn.awsli.com.br/307/307092/arquivos/serviceid_icon_selected.png\'));
		return;
	}
	
	// mouse over effect for payment methods
	function MouseOverPMCID(a_PMCID)
	{
		$(\'#PMCID_Icon_Over_\' + a_PMCID).css(\'background-image\', \'url(\' + IMAGES + \'payment/pmcid_icon_over.png)\');
	}
	
	// mouse out effect for payment methods
	function MouseOutPMCID(a_PMCID)
	{
		$(\'#PMCID_Icon_Over_\' + a_PMCID).css(\'background-image\', \'\');
	}
	
	// mouse over effect for products
	function MouseOverServiceID(a_ServiceID, a_ServiceCategoryID)
	{
		$(\'#ServiceID_Icon_Over_\' + a_ServiceID).css(\'background-image\', \'url(\' + IMAGES + \'payment/serviceid_icon_over.png)\');
		if (a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) {
			$(\'#ServiceID_Icon_Animation_1_\' + a_ServiceID).show();
			$(\'#ServiceID_Icon_New_\' + a_ServiceID).hide();
		}
	}
	
	// mouse out effect for products
	function MouseOutServiceID(a_ServiceID, a_ServiceCategoryID)
	{
		$(\'#ServiceID_Icon_Over_\' + a_ServiceID).css(\'background-image\', \'\');
		// mounts have an animation
		if ((a_ServiceCategoryID == g_QF_Mounts_ServiceCategoryID || a_ServiceCategoryID == g_QF_Outfits_ServiceCategoryID) && ($(\'#ServiceID_\' + a_ServiceID).attr(\'checked\') != \'checked\')) {
			$(\'#ServiceID_Icon_Animation_1_\' + a_ServiceID).hide();
			$(\'#ServiceID_Icon_New_\' + a_ServiceID).show();
		}
	}
</script>


<div id="ProgressBar">
	<div id="MainContainer">
		<div id="BackgroundContainer">
			<img id="BackgroundContainerLeftEnd" src="' . $layout_name . '/images/global/content/stonebar-left-end.gif">
			<div id="BackgroundContainerCenter">
				<div id="BackgroundContainerCenterImage" style="background-image:url(' . $layout_name . '/images/global/content/stonebar-center.gif);">
				</div>
			</div>
			<img id="BackgroundContainerRightEnd" src="' . $layout_name . '/images/global/content/stonebar-right-end.gif">
		</div>
		<img id="TubeLeftEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-left-green.gif">
		<img id="TubeRightEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-right-blue.gif">
		<div id="FirstStep" class="Steps">
			<div class="SingleStepContainer">
				<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-1-green.gif">
				<div class="StepText" style="font-weight:bold;">Select service</div>
			</div>
		</div>
		<div id="StepsContainer1">
			<div id="StepsContainer2">
				<div class="Steps" style="width:33%">
					<div class="TubeContainer">
						<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green-blue.gif">
					</div>
					<div class="SingleStepContainer">
						<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-2-blue.gif">
						<div class="StepText" style="font-weight:normal;">Select your character</div>
					</div>
				</div>
				<div class="Steps" style="width:33%">
					<div class="TubeContainer">
						<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-blue.gif">
					</div>
					<div class="SingleStepContainer">
						<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-3-blue.gif">
						<div class="StepText" style="font-weight:normal;">Confirm your order</div>
					</div>
				</div>
				<div class="Steps" style="width:33%">
					<div class="TubeContainer">
						<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-blue.gif">
					</div>
					<div class="SingleStepContainer">
						<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-4-blue.gif">
						<div class="StepText" style="font-weight:normal;">Summary</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 

<form method="post" action="">
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);">
				</span>
				<span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);">
				</span>
				<span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);">
				</span>
				<span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);">
				</span>
				<div class="Text">Select service</div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);">
				</span>
				<span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);">
				</span>
				<span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);">
				</span>
				<span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);">
				</span>
			</div>
		</div>
		
		<table class="Table5" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>
						<div class="InnerTableContainer">
							<table style="width:100%;">
								<tbody>
									<tr>
										<td> ';

        foreach ($config["site"]["shop_categories"] as $ServiceCategoryID => $data) {

            if ($data["enabled"]) {
                $main_content .= '
														<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'' . $ServiceCategoryID . '\', \'' . $data['description'] . '\', \'ProductCategoryHelperDiv_' . $data['id'] . '\');" onmouseout="$(\'#HelperDivContainer\').hide();">
															<div class="InnerTableTab ';
                if ($_REQUEST['ServiceCategoryID'] == $data["id"]) {
                    $main_content .= 'ActiveInnerTableTab';
                } $main_content .= '">
																<div id="ProductCategoryHelperDiv_' . $data['id'] . '" class="ProductCategoryHelperDiv"></div>
																<a href="?subtopic=shopsystem&ServiceCategoryID=' . $data['id'] . '">
																	<img src="' . $layout_name . '/images/payment/';
                if ($_REQUEST['ServiceCategoryID'] == $data["id"]) {
                    $main_content .= 'products_tab_active';
                } else {
                    $main_content .= 'products_tab_nonactive';
                } $main_content .= '.png">
																	<div class="InnerTableTabLabel">' . $ServiceCategoryID . '</div>';

                if ($data['new']) {
                    $main_content .= '<div class="RibbonNewProduct" style="background-image: url(' . $layout_name . '/images/payment/ribbon-tab-new-product.png);"></div>';
                }

                $main_content .= '
																</a>
															</div>
														</span>';
            }
        }

        $main_content .= '
											</td>
										</tr>
										<tr>
											<td>
												<div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);">
													</div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
															<tbody>
																<tr>
																	<td style="text-align: center;" align="center">
																		<div style="max-height: 500px; overflow-y: auto;">';

        if ($offer_list['item'])
            foreach ($offer_list['item'] as $item) {

                $main_content .= '
																			<div class="ServiceID_Icon_Container" id="ServiceID_Icon_Container_' . $item['id'] . '" onclick="ChangeService(' . $item['id'] . ', 2);" onmouseover="MouseOverServiceID(' . $item['id'] . ', 2);" onmouseout="MouseOutServiceID(' . $item['id'] . ', 2);">  
																				<div class="ServiceID_Icon_Container_Background" id="" style="background-image:url(' . $layout_name . '/images/payment/serviceid_icon_normal.png);">    <div class="ServiceID_Icon" id="ServiceID_Icon_' . $item['id'] . '" style="background-image:url(./images/items/' . $item['item_id'] . '.gif);" onclick="ChangeService(' . $item['id'] . ', 14);" onmouseover="MouseOverServiceID(' . $item['id'] . ', 14);" onmouseout="MouseOutServiceID(' . $item['id'] . ', 14);">
																				
																					<div class="PermanentDeactivated">
																						<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'' . htmlspecialchars($item['name']) . '\', \'' . htmlspecialchars($item['description']) . '<br/><br/>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																							<div class="ServiceID_HelperDiv"></div>
																						</span>
																					</div>
																					
																					<div class="PermanentDeactivated ServiceID_Deactivated_ByChoice" id="ServiceID_NotAllowed_' . $item['id'] . '" style="display: none;">
																						<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Service Info:\', \'<p>The product is not available for the selected payment method!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																							<div class="ServiceID_Deactivated" style="background-image: url(' . $layout_name . '/images/payment/serviceid_deactivated.png);"></div>
																						</span>
																					</div>';

                if ($item['new']) {
                    $main_content .= '<div class="RibbonNewProduct" style="background-image: url(' . $layout_name . '/images/payment/ribbon-new-product.png);"></div>';
                }

                $main_content .= '
																					<div class="ServiceID_Icon_Selected" id="ServiceID_Icon_Selected_' . $item['id'] . '"></div>     
																					
																					<div class="ServiceID_Icon_Over" id="ServiceID_Icon_Over_' . $item['id'] . '"></div><div class="ServiceID_Icon_Animation_1" id="ServiceID_Icon_Animation_1' . $item['id'] . '" style="background-image: url(' . $layout_name . '/images/payment/serviceid' . $item['id'] . '_animation_1.gif);"></div> 
																					
																					<label for="ServiceID_' . $item['id'] . '">
																						<div class="ServiceIDLabelContainer">  
																							<div class="ServiceIDLabel">    
																								<input type="radio" id="ServiceID_' . $item['id'] . '" name="ServiceID" value="' . $item['id'] . '" style="display: none;" required>' . htmlspecialchars($item['name']) . '  
																							</div>
																						</div>
																						<div class="ServiceIDPriceContainer">
																						<span class="ServiceIDPrice" id="PD_' . $item['id'] . '">' . $item['points'] . ' TP$</div>
																					</label>    
																				</div>  
																				</div>
																			</div>';
            }


        $main_content .= '	
																		</div>
																	</td>
																</tr> 																
															</tbody>
														</table>
													</div>
												</div>
												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
														</div>
														<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
														</div>
													</div>
												</div>
												
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">  
													<div class="TableContentContainer">   
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
														<form method="post" action="">
															<tr>
																<td bgcolor="#F1E0C6">																	
																	&nbsp;Your Points: <b>																
																	' . $user_premium_points . ' TP$</b>
																</td>
																<td bgcolor="#F1E0C6">																	
																	<div class="BigButton" style="float:right; background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
																		<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
																			<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);">
																			</div>
																			<a class="ButtonText" href="?subtopic=buypoints"> <img src="' . $layout_name . '/images/global/buttons/_sbutton_buypoints.gif"  alt="Buy points"/></a>
																		</div>
																	</div>
																</td>
															</tr> 										
															
															
															
														</table>  
													</div>
												</div>
												<br>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">  
													<div class="TableContentContainer">   
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
														<form method="post" action="">
															<tr>
																<td bgcolor="#F1E0C6">																	
																	<font color="red"><b>Atencao: Todos items sao entregues automaticamento por nosso sistema!</b></font>
																</td>
															</tr> 																									
														</table>  
													</div>
												</div>

												<div class="TableShadowContainer">
													<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
														<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
														</div>
														<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
														</div>
													</div>
												</div>
												
												
											</td>
										</tr>
										
										<tr>
											<td style="display:none;">
												<div class="TableShadowContainerRightTop">
													<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);">
													</div>
												</div>
												<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
													<div class="TableContentContainer">
														<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
															<tbody>
																<tr>
																	<td style="text-align: center;" align="center">
																		<div style="max-height: 240px; overflow-y: auto;">';

        $main_content .= '
																			<div class="PMCID_Icon_Container" id="PMCID_Icon_Container_1">
																				<div class="PMCID_Icon" id="PMCID_Icon_1" style="background-image:url(' . $layout_name . '/images//payment/pmcid_icon_normal.png);" onclick="ChangePMC(1);" onmouseover="MouseOverPMCID(1);" onmouseout="MouseOutPMCID(1);">
																					<div class="PermanentDeactivated PMCID_Deactivated_ByChoice" id="PMCID_NotAllowed_1" style="display: none;" "="">
																					<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Payment Method Info:\', \'
																					
																					<p>The payment method is not allowed for the selected service!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																						<div class="PMCID_Deactivated" style="background-image: url(' . $layout_name . '/images/payment/pmcid_deactivated.png);">
																						</div>
																					</span>
																				</div>
																				<div class="PMCID_Icon_Selected" id="PMCID_Icon_Selected_1"></div>
																				<div class="PMCID_Icon_Over" id="PMCID_Icon_Over_1"></div>
																				<span style="position: absolute; left: 125px; top: 53px; z-index: 99;">
																					<span style="margin-left: 5px; position: absolute; margin-top: 2px;">
																						<a href="../common/help.php?subtopic=Field-PaymentMethodCategory-Option-1" target="_blank">
																							<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Information:\', \'Your Points, go to buy points to donate and get more if you need.\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																								<img style="border:0px;" src="' . $layout_name . '/images/global/content/info.gif">
																							</span>
																						</a>
																					</span>
																				</span>
																				<img class="PMCID_CP_Icon" src="' . $layout_name . '/images/payment/paymentmethodcategory11.gif">
																				<div class="PMCID_CP_Label">
																					<input type="radio" id="PMCID_1" name="PMCID" value="1" style="display: none;" checked>
																					<label for="PMCID_1">Your points <br/>  Balance: ' . $account_logged->getCustomField("premium_points") . ' TP$</label>
																				</div>
																			</div>';

        $main_content .= '
																		</div>
																	</div>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="TableShadowContainer">
											<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
												<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
												</div>
												<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>




<div class="SubmitButtonRow">
	<div class="LeftButton">
		<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
			<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);"></div>
				<input type="hidden" name="page" value="orderinfo">
				<input class="ButtonText" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif">
			</div>
		</div>
	</div>
</form>
	<div class="RightButton">
		<form action="?subtopic=accountmanagement" method="post" style="padding:0px;margin:0px;">
			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);"></div>
					<input type="hidden" name="page" value="overview">
                                        <input class="ButtonText" type="image" name="Cancel" alt="Cancel" src="' . $layout_name . '/images/global/buttons/_sbutton_cancel.gif">
				</div>
			</div>
		</form>
	</div>
</div>

';
    }

    if ($_POST['page'] == 'orderinfo') {
        $main_content .= '
<div class="BoxContent" style="background-image:url(' . $layout_name . '/images/global/content/scroll.gif);">
	<div id="ProgressBar">
		<div id="MainContainer">
			<div id="BackgroundContainer">
				<img id="BackgroundContainerLeftEnd" src="' . $layout_name . '/images/global/content/stonebar-left-end.gif">
				<div id="BackgroundContainerCenter">
					<div id="BackgroundContainerCenterImage" style="background-image:url(' . $layout_name . '/images/global/content/stonebar-center.gif);">
					</div>
				</div>
				<img id="BackgroundContainerRightEnd" src="' . $layout_name . '/images/global/content/stonebar-right-end.gif">
			</div>
			<img id="TubeLeftEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-left-green.gif"><img id="TubeRightEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-right-blue.gif">
			<div id="FirstStep" class="Steps">
				<div class="SingleStepContainer">
					<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-1-green.gif">
					<div class="StepText" style="font-weight:normal;">
						Select service
					</div>
				</div>
			</div>
			<div id="StepsContainer1">
				<div id="StepsContainer2">
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-2-green.gif">
							<div class="StepText" style="font-weight:bold;">
								Select your character
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green-blue.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-3-blue.gif">
							<div class="StepText" style="font-weight:normal;">
								Confirm your order
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-blue.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-4-blue.gif">
							<div class="StepText" style="font-weight:normal;">
								Summary
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text">
					Select your character
				</div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span><span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			</div>
		</div>
		<table class="Table5" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table style="width:100%;">
					<tbody>
					<tr>
						<td>
							<div class="TableShadowContainerRightTop">
								<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);">
								</div>
							</div>
							<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
								<div class="TableContentContainer">
									<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">';

        $ServiceID = (int) $_POST['ServiceID'];

        if (empty($ServiceID)) {
            $main_content .= '<tr><td>Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select item</a> first.</tr></td>';
        } else {
            $ServiceOffer = getItemByID($ServiceID);

            if (isset($ServiceOffer['id'])) { //item exist in database
                if ($user_premium_points >= $ServiceOffer['points']) {
                    $main_content .= '
													<tr class="Odd">
														<td style="font-weight:bold; width: 1%;">';

                    $main_content .= '
															<div class="ServiceID_Icon_Container" id="ServiceID_Icon_Container_' . $ServiceOffer['id'] . '"> ';




                    $main_content .= '
																<div class="ServiceID_Icon_Container_Background" style="background-image:url(' . $layout_name . '/images/payment/serviceid_icon_normal.png);">
																	<div class="ServiceID_Icon" id="ServiceID_Icon_' . $ServiceOffer['id'] . '" style="background-image:url(./images/items/' . $ServiceOffer['item_id'] . '.gif); cursor: auto;">';


                    $main_content .= '		
																		<label for="ServiceID_' . $ServiceOffer['id'] . '">
																			<div class="ServiceIDLabelContainer">  
																				<div class="ServiceIDLabel" style="cursor: auto;">    
																					' . htmlspecialchars($ServiceOffer['name']) . '  
																				</div>
																			</div>
																			
																			<div class="PermanentDeactivated">
																				<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'' . htmlspecialchars($ServiceOffer['name']) . '\', \'' . htmlspecialchars($ServiceOffer['description']) . '<br/><br/>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																					<div class="ServiceID_HelperDiv"></div>
																				</span>
																			</div>
																					
																			<div class="PermanentDeactivated ServiceID_Deactivated_ByChoice" id="ServiceID_NotAllowed_' . $ServiceOffer['id'] . '" style="display: none;">
																				<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Service Info:\', \'<p>The product is not available for the selected payment method!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																					<div class="ServiceID_Deactivated" style="background-image: url(' . $layout_name . '/images/payment/serviceid_deactivated.png);"></div>
																				</span>
																			</div>
																			
																			<div class="ServiceIDPriceContainer" style="cursor: auto;">
																				<span class="ServiceIDPrice" id="PD_' . $ServiceOffer['id'] . '">' . $ServiceOffer['points'] . ' TP$</span>
																			</div>
																		</label> 
																		
																	</div>  
																</div>
															</div>';

                    $main_content .= '
														</td>
														
														<td>
															
															<form action="" method="POST">
																						
																<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
																	<tr bgcolor="' . $config['site']['vdarkborder'] . '"><td colspan="2" class="white"><b>Give item to player from your account</b></td></tr>
																	<tr bgcolor="' . $config['site']['lightborder'] . '"><td width="130"><b>Character name:</b></td><td><select name="buy_name" style="    width: 100%;    height: 30px;    display: block;    float: left; ">';
                    $players_from_logged_acc = $account_logged->getPlayersList();
                    if (count($players_from_logged_acc) > 0) {
                        foreach ($players_from_logged_acc as $player) {
                            $main_content .= '<option>' . htmlspecialchars($player->getName()) . '</option>';
                        }
                    } else {
                        $main_content .= 'You don\'t have any character on your account.';
                    }
                    $main_content .= '</select></td></tr>';

                    if ($ServiceOffer['type'] == 'itemvip') {
                        $main_content .= '<tr bgcolor="' . $config['site']['lightborder'] . '"><td width="130"><b>Quantity:</b></td><td><input type="text" name="quantity" value="1" style="width: 100%;  height: 25px;  line-height: 25px;" placeholder=" Quantity"></td></tr>';
                    }

                    $main_content .= '																
																																			
																		<tr bgcolor="' . $config['site']['vdarkborder'] . '"><td colspan="2" class="white"><b>Give item to other player</b></td></tr>
																		<tr bgcolor="' . $config['site']['lightborder'] . '"><td><b>To player:</b></td><td><input type="text" name="gift_name" style="width: 100%;  height: 25px;  line-height: 25px;" placeholder=" Name of player to give."></td></tr>
																		<tr bgcolor="' . $config['site']['lightborder'] . '"><td><b>From:</b></td><td><input type="text" name="gift_from" style="width: 100%;  height: 25px;  line-height: 25px;" placeholder=" Your nick, \'empty\' for Anonymous."></td></tr>
																		
																		';

                    $main_content .= '	
																</table>
																
																
															
															
															
														</td>
													</tr>
													
													';
                } else {
                    $main_content .= '<tr><td>For this item you need <b>' . $ServiceOffer['points'] . '</b> TP$. You have only <b>' . $user_premium_points . '</b> TP$. Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select other item</a> or buy TP$.</tr></td>';
                }
            } else {
                $main_content .= '<tr><td>Offer ID doesn\'t exist. Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select item</a> again.</tr></td>';
            }
        }

        $main_content .= '
									</table>
								</div>
							</div>
							<div class="TableShadowContainer">
								<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
									<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
									</div>
									<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
									</div>
								</div>
							</div>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="SubmitButtonRow">
		<div class="LeftButton">
			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);"></div>
                                    <input type="hidden" name="page" value="confirmorder">
                                    '. $_POST['ServiceID'] .'
                                    <input type="hidden" name="ServiceID" value="' . $_POST['ServiceID'] . '">
                                    <input class="ButtonText" type="image" name="Next" alt="Next" src="' . $layout_name . '/images/global/buttons/_sbutton_next.gif">
				</div>
			</div>
		</div>
		</form>
		<div class="RightButton">
			<form method="post" action="">
				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
						<input type="hidden" name="page" value="">
                                                <input type="hidden" name="ServiceID" value="' . $_POST['ServiceID'] . '">
                                                <input class="ButtonText" type="image" name="Previous" alt="Previous" src="' . $layout_name . '/images/global/buttons/_sbutton_previous.gif">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--script type="text/javascript" src="templates/js/utils.js"></script-->
</div>';
    }

    if ($_POST['page'] == 'confirmorder') {
        $main_content .= '
<div class="BoxContent" style="background-image:url(' . $layout_name . '/images/global/content/scroll.gif);">
	<div id="ProgressBar">
		<div id="MainContainer">
			<div id="BackgroundContainer">
				<img id="BackgroundContainerLeftEnd" src="' . $layout_name . '/images/global/content/stonebar-left-end.gif">
				<div id="BackgroundContainerCenter">
					<div id="BackgroundContainerCenterImage" style="background-image:url(' . $layout_name . '/images/global/content/stonebar-center.gif);">
					</div>
				</div>
				<img id="BackgroundContainerRightEnd" src="' . $layout_name . '/images/global/content/stonebar-right-end.gif">
			</div>
			<img id="TubeLeftEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-left-green.gif"><img id="TubeRightEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-right-blue.gif">
			<div id="FirstStep" class="Steps">
				<div class="SingleStepContainer">
					<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-1-green.gif">
					<div class="StepText" style="font-weight:normal;">
						Select service
					</div>
				</div>
			</div>
			<div id="StepsContainer1">
				<div id="StepsContainer2">
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-2-green.gif">
							<div class="StepText" style="font-weight:bold;">
								Select your character
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-3-green.gif">
							<div class="StepText" style="font-weight:normal;">
								Confirm your order
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green-blue.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-4-blue.gif">
							<div class="StepText" style="font-weight:normal;">
								Summary
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text">
					Confirm your order
				</div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span><span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			</div>
		</div>
		<table class="Table5" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table style="width:100%;">
					<tbody>
					<tr>
						<td>
							<div class="TableShadowContainerRightTop">
								<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);">
								</div>
							</div>
							<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
								<div class="TableContentContainer">
									<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">';

        $ServiceID = (int) $_POST['ServiceID'];

        if (empty($ServiceID)) {
            $main_content .= '<tr><td>Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select item</a> first.</tr></td>';
        } else {

            $ServiceOffer = getItemByID($ServiceID);
            $quantity = (int) $_POST['quantity'];
            $priece = (int) $ServiceOffer['points'];
            $total = $quantity * $priece;

            if (isset($ServiceOffer['id'])) { //item exist in database
                $errorcode = 0;
                if ($ServiceOffer['type'] == 'itemvip') {
                    if (!isInteger($_POST['quantity'])) {
                        $main_content .= '<tr><td>Please, enter a valid quantity (only integer numbers)!</tr></td>';
                        $errorcode = 1;
                    } elseif ((int) $_POST['quantity'] <= 0) {
                        $main_content .= '<tr><td>Please, quantity must be higher than 0!</tr></td>';
                        $errorcode = 1;
                    }
                }

                if ($errorcode == 0) {
                    if ($user_premium_points >= $ServiceOffer['points']) {
                        $main_content .= '<tr><td style="padding: 5px; line-height: 20px;">
                        <form action="" method="POST" style="margin: 0px;">
                        <b style="width: 150px; display: inline-block;">Item name:</b> ' . $ServiceOffer['name'] . '<br/>
			<b style="width: 150px; display: inline-block;">Item price:</b> ' . $ServiceOffer['points'] . ' TP$ from your account<br/>
			<!--<b style="width: 150px; display: inline-block;">Quantity:</b> ' . (int) $_POST['quantity'] . ' <br/>-->
			<!--<b style="width: 150px; display: inline-block;">Total:</b> ' . $total . ' TP$<br/>-->';
                        if ($_POST['gift_name']) {
                            $main_content .= '<b style="width: 150px; display: inline-block;">From:</b> ' . $_POST['gift_from'] . '<br/><b style="width: 150px; display: inline-block;">To:</b> ' . $_POST['gift_name'] . '<br/>';
                        } else {
                            $main_content .= '<b style="width: 150px; display: inline-block;">Owner:</b> ' . $_POST['buy_name'] . ' <small>[<a href="index.php?subtopic=characters&amp;name=' . $_POST['buy_name'] . '" target="_blank">View Character</a>]</small><br/>';
                        }
                        $main_content .= '<b style="width: 150px; display: inline-block;">Payment Method:</b> Points<br/></td></tr>';
                    } else {
                        $main_content .= '<tr><td>For this item you need <b>' . $ServiceOffer['points'] . '</b> TP$. You have only <b>' . $user_premium_points . '</b> TP$. Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select other item</a> or buy TP$.</tr></td>';
                    }
                }
            } else {
                $main_content .= '<tr><td>Offer ID doesn\'t exist. Please <a href="?subtopic=shopsystem&ServiceCategoryID=1">select item</a> again.</tr></td>';
            }
        }

        $main_content .= '
									</table>
								</div>
																
							</div>
							<div class="TableShadowContainer">
								<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
									<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
									</div>
									<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
									</div>
								</div>
							</div>
							
							<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">  
								<div class="TableContentContainer">   
									<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">
									<form method="post" action="">
										<tr>
											<td colspan="2">
												<input type="checkbox" name="order_contract" value="1" id="AgreementsCheckbox" required> 
												<span>
													<label for="AgreementsCheckbox">I have read and I agree to the <a href="?subtopic=legaldocuments" target="_blank">Extended Tibia Service Agreement</a>.</label>
												</span>
											</td>
										</tr> 
									</table>  
								</div>
							</div>
							<div class="TableShadowContainer">
								<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
									<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
									</div>
									<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
									</div>
								</div>
							</div>
							
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="SubmitButtonRow">
		<div class="LeftButton">
			<input type="hidden" name="page" value="summaryorder">
			<input type="hidden" name="viewed_confirmation_page" value="1">
			<input type="hidden" name="buy_confirmed" value="1">
			<input type="hidden" name="quantity" value="' . $_POST['quantity'] . '">
			<input type="hidden" name="buy_name" value="' . $_POST['buy_name'] . '">
			<input type="hidden" name="gift_name" value="' . $_POST['gift_name'] . '">
			<input type="hidden" name="gift_from" value="' . $_POST['gift_from'] . '">
			<input type="hidden" name="ServiceID" value="' . $_POST['ServiceID'] . '">';

        $_SESSION['add_itens'] = TRUE;

        $main_content .= '<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_green_over.gif);"></div>
					<input class="ButtonText" type="image" name="Buy now" alt="Buy now" src="' . $layout_name . '/images/global/buttons/_sbutton_buynow.gif">
				</div>
			</div>
		</div>
		</form>
		<div class="RightButton">
			<form method="post" action="">
				<input type="hidden" name="page" value="orderinfo">
				<input type="hidden" name="ServiceID" value="' . $_POST['ServiceID'] . '">
				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);"><div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);"></div>
						<input class="ButtonText" type="image" name="Previous" alt="Previous" src="' . $layout_name . '/images/global/buttons/_sbutton_previous.gif">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="templates/js/utils.js"></script>
</div>';
    }

    if ($_POST['page'] == 'summaryorder') {
        $main_content .= '
<div class="BoxContent" style="background-image:url(' . $layout_name . '/images/global/content/scroll.gif);">
	<div id="ProgressBar">
		<div id="MainContainer">
			<div id="BackgroundContainer">
				<img id="BackgroundContainerLeftEnd" src="' . $layout_name . '/images/global/content/stonebar-left-end.gif">
				<div id="BackgroundContainerCenter">
					<div id="BackgroundContainerCenterImage" style="background-image:url(' . $layout_name . '/images/global/content/stonebar-center.gif);">
					</div>
				</div>
				<img id="BackgroundContainerRightEnd" src="' . $layout_name . '/images/global/content/stonebar-right-end.gif">
			</div>
			<img id="TubeLeftEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-left-green.gif"><img id="TubeRightEnd" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-right-green.gif">
			<div id="FirstStep" class="Steps">
				<div class="SingleStepContainer">
					<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-1-green.gif">
					<div class="StepText" style="font-weight:normal;">
						Summary of your order
					</div>
				</div>
			</div>
			<div id="StepsContainer1">
				<div id="StepsContainer2">
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-2-green.gif">
							<div class="StepText" style="font-weight:bold;">
								Select your character
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-3-green.gif">
							<div class="StepText" style="font-weight:normal;">
								Confirm your order
							</div>
						</div>
					</div>
					<div class="Steps" style="width:33%">
						<div class="TubeContainer">
							<img class="Tube" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-tube-green.gif">
						</div>
						<div class="SingleStepContainer">
							<img class="StepIcon" src="' . $layout_name . '/images/global/content/progressbar/progress-bar-icon-4-green.gif">
							<div class="StepText" style="font-weight:normal;">
								Summary
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="TableContainer">
		<div class="CaptionContainer">
			<div class="CaptionInnerContainer">
				<span class="CaptionEdgeLeftTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightTop" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionBorderTop" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionVerticalLeft" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span>
				<div class="Text">
					Order summary
				</div>
				<span class="CaptionVerticalRight" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-vertical.gif);"></span><span class="CaptionBorderBottom" style="background-image:url(' . $layout_name . '/images/global/content/table-headline-border.gif);"></span><span class="CaptionEdgeLeftBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span><span class="CaptionEdgeRightBottom" style="background-image:url(' . $layout_name . '/images/global/content/box-frame-edge.gif);"></span>
			</div>
		</div>
		<table class="Table5" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td>
				<div class="InnerTableContainer">
					<table style="width:100%;">
					<tbody>
					<tr>
						<td>
							<div class="TableShadowContainerRightTop">
								<div class="TableShadowRightTop" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rt.gif);">
								</div>
							</div>
							<div class="TableContentAndRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-rm.gif);">
								<div class="TableContentContainer">
									<table class="TableContent" width="100%" style="border:1px solid #faf0d7;">';

        if (empty($_POST['ServiceID'])) {
            $errormessage .= 'Please <a href="?subtopic=shopsystem">select item</a> first.';
        } else {
            $buy_id = (int) $_POST['ServiceID'];
            $buy_offer = getItemByID($buy_id);
        }

        if ($_POST['gift_name']) {
            $buy_name = trim($_POST['gift_name']);
        } else {
            $buy_name = trim($_POST['buy_name']);
        }

        if (empty($_POST['gift_from'])) {
            $buy_from = 'Anonymous';
        } else {
            $buy_from = trim($_POST['gift_from']);
        }

        if (empty($_POST['order_contract'])) {
            $errormessage .= 'You need accept terms.';
        }

        if ($buy_offer['type'] == 'itemvip') {
            if (!isInteger($_POST['quantity'])) {
                $errormessage .= 'Please, enter a valid quantity (only integer numbers)!';
            }

            if ((int) $_POST['quantity'] <= 0) {
                $errormessage .= 'Please, quantity must be higher than 0!';
            }
        }

        if (!check_name($buy_from)) {
            $errormessage .= 'Invalid nick ("from player") format. Please <a href="?subtopic=shopsystem&action=select_player&buy_id=' . $buy_id . '">select other name</a> or contact with administrator.';
        } else {
            if ($_SESSION['add_itens'] and empty($errormessage)) {

                $buy_offer = getItemByID($buy_id);
                if (isset($buy_offer['id'])) { //item exist in database
                    if ($user_premium_points >= $buy_offer['points']) {
                        if (check_name($buy_name)) {
                            $buy_player = new OTS_Player();
                            $buy_player->find($buy_name);
                            if ($buy_player->isLoaded()) {
                                $buy_player_account = $buy_player->getAccount();
                                if ($_POST['viewed_confirmation_page'] && $_POST['buy_confirmed']) {
                                    $buy_type = 'give_item';
                                    $selectedCount = 1;

                                    if ($buy_offer['type'] == 'vipdays') {
                                        $buy_type = 'vipdays';
                                    } elseif ($buy_offer['type'] == 'pacc') {
                                        $buy_type = 'pacc';
                                    }

                                    if ($buy_offer['type'] == 'itemvip') {
                                        $selectedCount = $_POST['quantity'];
                                        $totalQ = (int) $buy_offer['item_count'] * (int) $selectedCount;
                                        $totalP = $totalQ * (int) $buy_offer['points'];
                                    } else {
                                        $totalQ = (int) $buy_offer['item_count'];
                                        $totalP = (int) $buy_offer['points'];
                                    }



                                    $sql = 'INSERT INTO ' . $SQL->tableName('z_ots_comunication') . ' (' . $SQL->fieldName('id') . ',' . $SQL->fieldName('name') . ',' . $SQL->fieldName('type') . ',' . $SQL->fieldName('action') . ',' . $SQL->fieldName('param1') . ',' . $SQL->fieldName('param2') . ',' . $SQL->fieldName('param3') . ',' . $SQL->fieldName('param4') . ',' . $SQL->fieldName('param5') . ',' . $SQL->fieldName('param6') . ',' . $SQL->fieldName('param7') . ',' . $SQL->fieldName('delete_it') . ') VALUES (NULL, ' . $SQL->quote($buy_player->getName()) . ', ' . $SQL->quote('login') . ', ' . $SQL->quote($buy_type) . ', ' . $SQL->quote($buy_offer['item_id']) . ', ' . $SQL->quote($totalQ) . ', ' . $SQL->quote('') . ', ' . $SQL->quote('') . ', ' . $SQL->quote('item') . ', ' . $SQL->quote($buy_offer['name']) . ', ' . $SQL->quote('') . ', ' . $SQL->quote(1) . ');';
                                    $SQL->query($sql);
                                    $save_transaction = 'INSERT INTO ' . $SQL->tableName('z_shop_history_item') . ' (' . $SQL->fieldName('id') . ',' . $SQL->fieldName('to_name') . ',' . $SQL->fieldName('to_account') . ',' . $SQL->fieldName('from_nick') . ',' . $SQL->fieldName('from_account') . ',' . $SQL->fieldName('price') . ',' . $SQL->fieldName('offer_id') . ',' . $SQL->fieldName('trans_state') . ',' . $SQL->fieldName('trans_start') . ',' . $SQL->fieldName('trans_real') . ') VALUES (' . $SQL->lastInsertId() . ', ' . $SQL->quote($buy_player->getName()) . ', ' . $SQL->quote($buy_player_account->getId()) . ', ' . $SQL->quote($buy_from) . ',  ' . $SQL->quote($account_logged->getId()) . ', ' . $SQL->quote($buy_offer['points']) . ', ' . $SQL->quote($buy_offer['name']) . ', ' . $SQL->quote('wait') . ', ' . $SQL->quote(time()) . ', ' . $SQL->quote(0) . ');';
                                    $SQL->query($save_transaction);
                                    $account_logged->setCustomField('premium_points', (int) $user_premium_points - (int) $totalP);
                                    $user_premium_points = $user_premium_points - $totalP;
                                    $main_content .= '<TR style="padding: 5px; line-height: 20px;">>
						<TD BGCOLOR="' . $config['site']['darkborder'] . '" ALIGN=left>																		
					<b>' . htmlspecialchars($buy_offer['name']) . '</b> foi enviado ao player <b>' . htmlspecialchars($buy_player->getName()) . '</b>.<br/>
							Aguarde alguns segundos para receber.<br/> 
							Foram debitados <b>' . $totalP . ' TP$</b> da sua conta.<br/>
							Saldo disponível: <b>' . $user_premium_points . ' TP$</b>.
							Obrigado por colaborar! Lembramos que convertemos todo o dinheiro arrecadado em recursos para o próprio servidor. 
						</TD>
                                                        <td style="font-weight:bold; width: 1%;">
							<div class="ServiceID_Icon_Container" id="ServiceID_Icon_Container_' . $buy_offer['id'] . '">  
							<div class="ServiceID_Icon_Container_Background" style="background-image:url(' . $layout_name . '/images/payment/serviceid_icon_normal.png);">
							<div class="ServiceID_Icon" id="ServiceID_Icon_' . $buy_offer['id'] . '" style="background-image:url(./images/items/' . $buy_offer['item_id'] . '.gif); cursor: auto;"><label for="ServiceID_' . $buy_offer['id'] . '"><div class="ServiceIDLabelContainer">
                                                <div class="ServiceIDLabel" style="cursor: auto;">' . htmlspecialchars($buy_offer['name']) . '</div>
                                                    </div>
                                                    <div class="PermanentDeactivated">
																								<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'' . htmlspecialchars($buy_offer['name']) . '\', \'' . htmlspecialchars($buy_offer['description']) . '<br/><br/>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																									<div class="ServiceID_HelperDiv"></div>
																								</span>
																							</div>
																									
																							<div class="PermanentDeactivated ServiceID_Deactivated_ByChoice" id="ServiceID_NotAllowed_' . $buy_offer['id'] . '" style="display: none;">
																								<span class="HelperDivIndicator" onmouseover="ActivateHelperDiv($(this), \'Service Info:\', \'<p>The product is not available for the selected payment method!</p>\', \'\');" onmouseout="$(\'#HelperDivContainer\').hide();">
																									<div class="ServiceID_Deactivated" style="background-image: url(' . $layout_name . '/images/payment/serviceid_deactivated.png);"></div>
																								</span>
																							</div>
																							
																							<div class="ServiceIDPriceContainer" style="cursor: auto;">
																								<span class="ServiceIDPrice" id="PD_' . $buy_offer['id'] . '">' . $buy_offer['points'] . ' TP$</span>
																							</div>
																						</label> 
																						
																					</div>  
																				</div>
																			</div>
																		</td>
																	</TR>';
                                }
                            } else {
                                $errormessage .= 'Player with name <b>' . htmlspecialchars($buy_name) . '</b> doesn\'t exist. Please <a href="?subtopic=shopsystem&action=select_player&buy_id=' . $buy_id . '">select other name</a>.';
                            }
                        } else {
                            $errormessage .= 'Invalid name format. Please <a href="?subtopic=shopsystem&action=select_player&buy_id=' . $buy_id . '">select other name</a> or contact with administrator.';
                        }
                    } else {
                        $errormessage .= 'For this item you need <b>' . $buy_offer['points'] . '</b> points. You have only <b>' . $user_premium_points . '</b> premium points. Please <a href="?subtopic=shopsystem">select other item</a> or buy premium points.';
                    }
                } else {
                    $errormessage .= 'Offer with ID <b>' . $buy_id . '</b> doesn\'t exist. Please <a href="?subtopic=shopsystem">select item</a> again.';
                }

                if ($_SESSION['add_itens']) {
                    $_SESSION['add_itens'] = FALSE;
                }
            } else {
                if (empty($errormessage)) {
                    $main_content .= '
														<TR>
															<TD>
																Seu pedido está sendo processado, por favor aguarde alguns segundos!
															</TR>
														</TD>';
                }
            }
        }

        if (!empty($errormessage)) {
            $main_content .= '<TABLE WIDTH=100% BORDER=0 CELLSPACING=1 CELLPADDING=4>
												<TR><TD BGCOLOR="' . $config['site']['vdarkborder'] . '" ALIGN=left CLASS=white><B>Informations</B></TD></TR>
												<TR><TD BGCOLOR="' . $config['site']['lightborder'] . '" ALIGN=left><b>' . $errormessage . '</b></TD></TR>
												</table>';
        }

        $main_content .= '									
								</table>
								</div>
																
							</div>
							<div class="TableShadowContainer">
								<div class="TableBottomShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bm.gif);">
									<div class="TableBottomLeftShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-bl.gif);">
									</div>
									<div class="TableBottomRightShadow" style="background-image:url(' . $layout_name . '/images/global/content/table-shadow-br.gif);">
									</div>
								</div>
							</div>
							

							
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
	<div class="SubmitButtonRow">
		<form method="post" action="">
		<div class="LeftButton">
		
			<input type="hidden" name="page" value="">
			<input type="hidden" name="viewed_confirmation_page" value="">
			<input type="hidden" name="buy_confirmed" value="">
			<input type="hidden" name="buy_name" value="">
			<input type="hidden" name="gift_name" value="">
			<input type="hidden" name="gift_from" value="">
			<input type="hidden" name="ServiceID" value="">
			<input type="hidden" name="order_contract" value="">
			
			<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red.gif)">
				<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
					<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_red_over.gif);">
					</div>
					<input class="ButtonText" type="image" name="Buy now" alt="Buy now" src="' . $layout_name . '/images/global/buttons/_sbutton_backshop.gif">
				</div>
			</div>
		</div>
		</form>
		
		<div class="RightButton">
			<form method="post" action="?subtopic=accountmanagement">
				<input type="hidden" name="page" value="">
				<input type="hidden" name="viewed_confirmation_page" value="">
				<input type="hidden" name="buy_confirmed" value="">
				<input type="hidden" name="buy_name" value="">
				<input type="hidden" name="gift_name" value="">
				<input type="hidden" name="gift_from" value="">
				<input type="hidden" name="ServiceID" value="">	
				
				<div class="BigButton" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton.gif)">
					<div onmouseover="MouseOverBigButton(this);" onmouseout="MouseOutBigButton(this);">
						<div class="BigButtonOver" style="background-image:url(' . $layout_name . '/images/global/buttons/sbutton_over.gif);">
						</div>
						<input class="ButtonText" type="image" name="Back" alt="Back" src="' . $layout_name . '/images/global/buttons/_sbutton_manageaccount.gif">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="templates/js/utils.js"></script>
</div>';
    }


    $main_content .= '
<script type="text/javascript">

$(\'#SelectCountrySubmitButton\').hide();
$(\'.PMCID_CP_Label > input\').hide();
$(\'.ServiceIDLabel > input\').hide();
ChangeService(1, 11);
</script>

<script type="text/javascript">
	$(\'#SelectCountrySubmitButton\').hide();
	$(\'.PMCID_CP_Label > input\').hide();
	$(\'.ServiceIDLabel > input\').hide();
	ChangeService(1, 12); 
</script>


<div id="HelperDivContainer" style="background-image: url(./layouts/tibiacom/images/content/scroll.gif);">
    <div class="HelperDivArrow" style="background-image: url(./layouts/tibiacom/images/content/helper-div-arrow.png);"></div>
    <div id="HelperDivHeadline"></div>
    <div id="HelperDivText"></div>
    <center>
        <img class="Ornament" src="./layouts/tibiacom/images/content/ornament.gif">
    </center>
    <br>
</div>


';
} else {
    header('Location: ' . '?subtopic=accountmanagement');
}
?>