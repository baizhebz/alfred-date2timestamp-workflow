<?php
require 'workflows.php';

if ( ! ini_get('date.timezone'))
{
	date_default_timezone_set('Asia/Chongqing');
}

$wf = new workflows();

$query = '{query}';

if ($query == '')
{
	$now = time();
	$wf->result(uniqid(), $now, '现在的unix时间戳是: '.$now , 'current unix timestamp: '.$now, 'icon.png');
}
else if (is_numeric($query) && strlen($query) === 10)
{
	$date = date('Y-m-d H:i:s', $query);
	$wf->result(uniqid(), $date, '对应的日期-时间是: '.$date , 'current datetime: '.$date, 'icon.png');
}
else
{
	$datetime_ts = strtotime($query);
	if ($datetime_ts === FALSE)
	{
		$wf->result(uniqid(), '', 'Oops,输入有误啊', '无法转换成日期或时间戳', 'icon.png');	
	}
	else
	{
		$wf->result(uniqid(), $datetime_ts, '该日期对应的时间戳是: '.$datetime_ts , 'the unix timestamp: '.$datetime_ts, 'icon.png');
	}
}

echo $wf->toxml();
