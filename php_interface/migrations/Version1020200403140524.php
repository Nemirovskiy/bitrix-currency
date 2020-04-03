<?php

namespace Sprint\Migration;


class Version1020200403140524 extends Version
{
	protected $description = "Начальное состояние Почтовых событий";

	protected $moduleVersion = "3.14.6";

	/**
	 * @throws Exceptions\HelperException
	 * @return bool|void
	 */
	public function up()
	{
		$helper = $this->getHelperManager();
		$helper->Event()->saveEventType('SALE_NEW_ORDER', array (
			'LID' => 'ru',
			'EVENT_TYPE' => 'email',
			'NAME' => 'Новый заказ',
			'DESCRIPTION' => '#ORDER_ID# - код заказа
#ORDER_ACCOUNT_NUMBER_ENCODE# - код заказа(для ссылок)
#ORDER_REAL_ID# - реальный ID заказа
#ORDER_DATE# - дата заказа
#ORDER_USER# - заказчик
#PRICE# - сумма заказа
#EMAIL# - E-Mail заказчика
#BCC# - E-Mail скрытой копии
#ORDER_LIST# - состав заказа
#ORDER_PUBLIC_URL# - ссылка для просмотра заказа без авторизации (требуется настройка в модуле интернет-магазина)
#SALE_EMAIL# - E-Mail отдела продаж',
			'SORT' => '100',
		));
		$helper->Event()->saveEventType('SALE_NEW_ORDER', array (
			'LID' => 'en',
			'EVENT_TYPE' => 'email',
			'NAME' => 'New order',
			'DESCRIPTION' => '#ORDER_ID# - order ID
#ORDER_ACCOUNT_NUMBER_ENCODE# - order ID (for URL\'s)
#ORDER_REAL_ID# - real order ID
#ORDER_DATE# - order date
#ORDER_USER# - customer
#PRICE# - order amount
#EMAIL# - customer e-mail
#BCC# - BCC e-mail
#ORDER_LIST# - order contents
#ORDER_PUBLIC_URL# - order view link for unauthorized users (requires configuration in the e-Store module settings)
#SALE_EMAIL# - sales dept. e-mail',
			'SORT' => '100',
		));
		$helper->Event()->saveEventMessage('SALE_NEW_ORDER', array (
			'LID' =>
				array (
					0 => 's1',
				),
			'ACTIVE' => 'Y',
			'EMAIL_FROM' => '#SALE_EMAIL#',
			'EMAIL_TO' => '#EMAIL#',
			'SUBJECT' => '#SITE_NAME#: Новый заказ N#ORDER_ID#',
			'MESSAGE' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<style>
		body
		{
			font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif;
			font-size: 14px;
			color: #000;
		}
	</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
	<tr>
		<td height="83" width="850" bgcolor="#eaf3f5" style="border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td bgcolor="#ffffff" height="75" style="font-weight: bold; text-align: center; font-size: 26px; color: #0b3961;">Вами оформлен заказ в магазине #SITE_NAME#</td>
				</tr>
				<tr>
					<td bgcolor="#bad3df" height="11"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
			<p style="margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px;">Уважаемый #ORDER_USER#,</p>
			<p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">Ваш заказ номер #ORDER_ID# от #ORDER_DATE# принят.<br />
<br />
Стоимость заказа: #PRICE#.<br />
<br />
Состав заказа:<br />
#ORDER_LIST#<br />
<br />
Вы можете следить за выполнением своего заказа (на какой стадии выполнения он находится), войдя в Ваш персональный раздел сайта #SITE_NAME#.<br />
<br />
Обратите внимание, что для входа в этот раздел Вам необходимо будет ввести логин и пароль пользователя сайта #SITE_NAME#.<br />
<br />
Для того, чтобы аннулировать заказ, воспользуйтесь функцией отмены заказа, которая доступна в Вашем персональном разделе сайта #SITE_NAME#.<br />
<br />
Пожалуйста, при обращении к администрации сайта #SITE_NAME# ОБЯЗАТЕЛЬНО указывайте номер Вашего заказа - #ORDER_ID#.<br />
<br />
Спасибо за покупку!<br />
</p>
		</td>
	</tr>
	<tr>
		<td height="40px" width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 30px; padding-left: 44px;">
			<p style="border-top: 1px solid #d1d1d1; margin-bottom: 5px; margin-top: 0; padding-top: 20px; line-height:21px;">С уважением,<br />администрация <a href="http://#SERVER_NAME#" style="color:#2e6eb6;">Интернет-магазина</a><br />
				E-mail: <a href="mailto:#SALE_EMAIL#" style="color:#2e6eb6;">#SALE_EMAIL#</a>
			</p>
		</td>
	</tr>
</table>
</body>
</html>',
			'BODY_TYPE' => 'html',
			'BCC' => '#BCC#',
			'REPLY_TO' => NULL,
			'CC' => NULL,
			'IN_REPLY_TO' => NULL,
			'PRIORITY' => NULL,
			'FIELD1_NAME' => NULL,
			'FIELD1_VALUE' => NULL,
			'FIELD2_NAME' => NULL,
			'FIELD2_VALUE' => NULL,
			'SITE_TEMPLATE_ID' => NULL,
			'ADDITIONAL_FIELD' =>
				array (
				),
			'LANGUAGE_ID' => NULL,
			'EVENT_TYPE' => '[ SALE_NEW_ORDER ] Новый заказ',
		));
		$helper->Event()->saveEventMessage('SALE_NEW_ORDER', array (
			'LID' =>
				array (
					0 => 'ay',
				),
			'ACTIVE' => 'Y',
			'EMAIL_FROM' => '#SALE_EMAIL#',
			'EMAIL_TO' => '#EMAIL#',
			'SUBJECT' => '#SITE_NAME#: Новый заказ N#ORDER_ID#',
			'MESSAGE' => 'Информационное сообщение сайта #SITE_NAME#<br>
 ------------------------------------------<br>
 <br>
 Уважаемый #ORDER_USER#,<br>
 <br>
 Ваш заказ номер #ORDER_ID# от #ORDER_DATE# принят.<br>
 <br>
 Стоимость заказа: #PRICE#.<br>
 <br>
 Состав заказа:<br>
 #ORDER_LIST#<br>
 <br>
 Вы можете следить за выполнением своего заказа (на какой<br>
 стадии выполнения он находится), войдя в Ваш персональный<br>
 раздел сайта #SITE_NAME#. Обратите внимание, что для входа<br>
 в этот раздел Вам необходимо будет ввести логин и пароль<br>
 пользователя сайта #SITE_NAME#.<br>
 <br>
 Для того, чтобы аннулировать заказ, воспользуйтесь функцией<br>
 отмены заказа, которая доступна в Вашем персональном<br>
 разделе сайта #SITE_NAME#.<br>
 <br>
 Пожалуйста, при обращении к администрации сайта #SITE_NAME#<br>
 ОБЯЗАТЕЛЬНО указывайте номер Вашего заказа - #ORDER_ID#.<br>
 <br>
Спасибо за покупку!',
			'BODY_TYPE' => 'html',
			'BCC' => '#BCC#',
			'REPLY_TO' => '',
			'CC' => '',
			'IN_REPLY_TO' => '',
			'PRIORITY' => '',
			'FIELD1_NAME' => '',
			'FIELD1_VALUE' => '',
			'FIELD2_NAME' => '',
			'FIELD2_VALUE' => '',
			'SITE_TEMPLATE_ID' => '',
			'ADDITIONAL_FIELD' =>
				array (
				),
			'LANGUAGE_ID' => '',
			'EVENT_TYPE' => '[ SALE_NEW_ORDER ] Новый заказ',
		));
	}

	public function down()
	{
		//your code ...
	}
}
