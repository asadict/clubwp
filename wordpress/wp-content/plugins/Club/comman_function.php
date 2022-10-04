<?php 

function selectClubDistrict($name, $select=''){
	$districts = array(
		1 => 'old town',
		2 => 'Outside Fribourg',
		3 => 'Betzenhausen',
		4 => 'Bruehl',
		5 => 'paves',
		6 => 'Guenterstal',
		7 => 'Haslach',
		8 => 'herders',
		9 => 'Chapel',
		10 => 'landwater',
		11 => 'fief',
		12 => 'littenweiler',
		13 => 'moss forest',
		14 => 'Mundenhof',
		15 => 'Munzingen',
		16 => 'Neuburg',
		17 => 'Oberau',
		18 => 'Opfingen',
		19 => 'drainage field',
		20 => 'St. George',
		21 => 'stuhlinger',
		22 => 'Tiengen',
		23 => 'Vauban',
		24 => 'forest lake',
		25 => 'Waltershofen',
		26 => 'vineyard',
		27 => 'Wiehre',
		28 => 'Zahringen'
	);
	$value = '';
	foreach($districts as $key => $district){
		$selected = ($select == $key && $select != '') ? "selected" : "";
		$value .= '<option class="busy" value="'.$key.'" '.$selected.'>'.$district.'</option>';
	}
	$select = '<select name="'.$name.'" id="'.$name.'" class="custom-form-control">';
	$select .= '<option value="">districts</option>';
	$select .= $value;
	$select .='</select>';
	return $select;
}
function getDistrictById($id){
	$districts = array(
		1 => 'old town',
		2 => 'Outside Fribourg',
		3 => 'Betzenhausen',
		4 => 'Bruehl',
		5 => 'paves',
		6 => 'Guenterstal',
		7 => 'Haslach',
		8 => 'herders',
		9 => 'Chapel',
		10 => 'landwater',
		11 => 'fief',
		12 => 'littenweiler',
		13 => 'moss forest',
		14 => 'Mundenhof',
		15 => 'Munzingen',
		16 => 'Neuburg',
		17 => 'Oberau',
		18 => 'Opfingen',
		19 => 'drainage field',
		20 => 'St. George',
		21 => 'stuhlinger',
		22 => 'Tiengen',
		23 => 'Vauban',
		24 => 'forest lake',
		25 => 'Waltershofen',
		26 => 'vineyard',
		27 => 'Wiehre',
		28 => 'Zahringen'
	);
	return $districts[$id];
}
?>