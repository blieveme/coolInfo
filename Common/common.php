<?
load('extend');
function sql_date(){
	return date('Y-m-d');
}
function getN($date){
	$arrayN = array('星期一','星期二','星期三','星期四','星期五','星期六','星期日');
	return date('Y年m月d日 ',strtotime($date)).$arrayN[date('N',strtotime($date))];
	//return $date;
}

?>