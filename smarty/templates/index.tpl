{include file = "$header_template.tpl" year='2015'}

{assign var='time' value = '13:33'}

привет, {$name|upper} ,как дела
<br>
{if $name eq 'Ilnar'}
    Мое имя Ильнар
{else}
    Мое имя не Ильнар
{/if}

<br>
текущее время {$time}
<br>

Имя сервера: {$smarty.server.SERVER_NAME} {*$_SERVER['SERVER_NAME']*}
<br>
{if isset($smarty.get.id)}
ID = {$smarty.get.id}{*$_GET['id']*}
{else}
    ID = not get
{/if}
<br>
Имя(ассоциативный):{$names.first}
<br>
Имя0:{$names[0]}
<br>
{html_select_date display_days = yes}
<br>
{mailto address = '123@ya.ru'}
<br>
Operation: {$raz+$dva}
<br>
Contacts: {$Contacts.phone.cell}
<br>
i_massive : {$i_massive[1]}

<br>

time: {$smarty.now|date_format:"%d.%m.%Y"}

<br>

time():{$raz|date_format:"%d/%m/%Y"}

<ul>
    {foreach from = $items_list key = key item = item name='href'}{* foreach($items_list as $key=>$item){} *}
        <li><a href="item.php?id={$key}">{$item.no}:{$item.label} | {$smarty.foreach.href.iteration} | {$smarty.foreach.href.first} </a></li>
    {foreachelse}
        Ничего не найдено
    {/foreach}
     
</ul>
    
<br>

{php}
    global $not_smarty;
    echo $not_smarty;
{/php}
<br>
{html_options name=customer_id options=$cust_options selected=$customer_id}
<br>

{html_table loop=$data cols = 'first,second,third,fourth' tr_attr=$tr}
<br>

{include file = 'footer.tpl'}