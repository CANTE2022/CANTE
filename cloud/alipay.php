<?php

if( $_SERVER['HTTP_REFERER'] == "" ){
header("");
echo '<script type="text/javascript">window.location.href="/"</script>'; 
exit('错误');}

include "includes/commons.inc.php";
phpdisk_core::user_login();
$je = trim(gpc('te_je','P',''));


require_once("alipay/alipay.config.php");
require_once("alipay/lib/alipay_service.class.php");

$out_trade_no = date(YmdHis);
$subject      = '在线支付';
$body         = '在线支付';
$total_fee    = $je;

$ins = array(
'order_number'=>$out_trade_no,
'pay_method'=>'支付宝',
'userid' => $pd_uid,
'pay_status' => 'fail',
'in_time'=>time(),
'ip' => $onlineip,
'total_fee'=>$je,
);
@$db->query_unbuffered("insert into {$tpf}orders set ".$db->sql_array($ins).";");


$paymethod    = '';
//默认网银代号，代号列表见"即时到帐接口"技术文档"附录"→"银行列表"
$defaultbank  = '';


//扩展功能参数——防钓鱼//

//防钓鱼时间戳
$anti_phishing_key  = '';
//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
$exter_invoke_ip = '';
//注意：
//1.请慎重选择是否开启防钓鱼功能
//2.exter_invoke_ip、anti_phishing_key一旦被使用过，那么它们就会成为必填参数
//3.开启防钓鱼功能后，服务器、本机电脑必须支持SSL，请配置好该环境。
//示例：
//$exter_invoke_ip = '202.1.1.1';
//$ali_service_timestamp = new AlipayService($aliapy_config);
//$anti_phishing_key = $ali_service_timestamp->query_timestamp();//获取防钓鱼时间戳函数


//扩展功能参数——其他//

//商品展示地址，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
$show_url			= '';
//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
$extra_common_param = '';

//扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
$royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
$royalty_parameters	= "";
//注意：
//提成信息集，与需要结合商户网站自身情况动态获取每笔交易的各分润收款账号、各分润金额、各分润说明。最多只能设置10条
//各分润金额的总和须小于等于total_fee
//提成信息集格式为：收款方Email_1^金额1^备注1|收款方Email_2^金额2^备注2
//示例：
//royalty_type 		= "10"
//royalty_parameters= "111@126.com^0.01^分润备注一|222@126.com^0.01^分润备注二"

/************************************************************/

//构造要请求的参数数组
$parameter = array(
		"service"			=> "create_direct_pay_by_user",
		"payment_type"		=> "1",
		
		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
        "seller_email"		=> trim($aliapy_config['seller_email']),
        "return_url"		=> trim($aliapy_config['return_url']),
        "notify_url"		=> trim($aliapy_config['notify_url']),
		
		"out_trade_no"		=> $out_trade_no,
		"subject"			=> $subject,
		"body"				=> $body,
		"total_fee"			=> $total_fee,
		
		"paymethod"			=> $paymethod,
		"defaultbank"		=> $defaultbank,
		
		"anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,
		
		"show_url"			=> $show_url,
		"extra_common_param"=> $extra_common_param,
		
		"royalty_type"		=> $royalty_type,
		"royalty_parameters"=> $royalty_parameters
);

//构造即时到帐接口
$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->create_direct_pay_by_user($parameter);
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>支付宝即时支付</title>
        <style type="text/css">
            .font_content{
                font-family:"宋体";
                font-size:14px;
                color:#FF6600;
            }
            .font_title{
                font-family:"宋体";
                font-size:16px;
                color:#FF0000;
                font-weight:bold;
            }
            table{
                border: 1px solid #CCCCCC;
            }
        </style>
    </head>
    <body>
        <table align="center" width="350" cellpadding="5" cellspacing="0">
            <tr>
                <td align="center" class="font_title" colspan="2">订单确认</td>
            </tr>
            <tr>
                <td class="font_content" align="right">订单号：</td>
                <td class="font_content" align="left"><?php echo $out_trade_no; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">付款总金额：</td>
                <td class="font_content" align="left"><?php echo $total_fee; ?></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><?php echo $html_text; ?></td>
            </tr>
        </table>
    </body>
</html>
