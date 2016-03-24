 {include file='header_1.tpl'}
 
    <form  method="post" action = "{$smarty.server.PHP_SELF}" name = "form_1">
        <h2>Доска объявлений</h2>
            <div> 
                <label class="form-label-radio">
                    <input type="radio" value=0 checked="" {if $display->getPrivate() eq 0}checked{/if} name="private">Частное лицо
                    <input type="radio" value=1 {if $display->getPrivate() eq 1}checked{/if} name="private">Компания
                </label>  
            </div>    
        <div> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="form-input-text" value="{$display->getSeller_name()}" name="seller_name" id="fld_seller_name">
        </div>
   
        <div> <label for="fld_email" class="form-label">Электронная почта</label>
            <input type="text" class="form-input-text" value= "{$display->getEmail()}" name="email" id="fld_email">
        </div>

    
        <div> 
            <label id="fld_phone_label" for="fld_phone">Номер телефона</label> 
            <input type="text" class="form-input-text" value="{$display->getPhone()}" name="phone" id="fld_phone">
        </div>
    
        <div class="form-group">
            <label for="region" class="col-sm-2 control-label">Город</label>
            {html_options name=city_id options=$cities selected=$display->getCity_id()}
        </div>
                   
        <div id="f_checkbox"> 
            <p> Получать рассылку? </p>
            <p><input type = "checkbox" name="allow_mail" value="Yes" {if $display->getAllow_mail() eq 'Yes'}checked{/if}> Да</p>
        </div> 
                                
        <div class="form-group">
            <label for="fld_category_id" class="form-label">Категория</label> 
            {html_options name=category_id options=$categories selected=$display->getCategory_id()}
        </div> 
        <div> 
            <label for="fld_title" class="form-label">Название объявления</label> 
            <input type="text" maxlength="50" class="form-input-text-long" value="{$display->getTitle()}" name="title" id="fld_title"> 
        </div>

        <div> 
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
            <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea">{$display->getDescription()}</textarea> 
        </div>

        <div> 
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label> 
            <input type="text" maxlength="9" class="form-input-text-short" value="{$display->getPrice()}" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.
        </div>
        
         <br>
         
        <input type="submit" value="{if isset($smarty.get.click_id)}Сохранить{else}Добавить{/if} объявление" id="form_submit" name="confirm_add">
        {if isset($smarty.get.click_id)}<input type="submit" value="Назад" id="form_submit" name="back">{/if}
        
         <br>
         <br>
         
        <input type="submit" value="Очистить форму" id="form_submit" name="clear_form">
        <input type="submit" value="Очистить базу объявлений" id="clear_base" name="clear_base">       
        <input type="hidden" name="id_r" value="{if isset($smarty.get.click_id)}{$smarty.get.click_id}{/if}">
    </form>
    
        <table>
            {foreach from=$ads key=myId item=i name='ads'}      {* foreach($items as $myId => $i)*}
                <tr>
                    <td><a href='{$smarty.server.SCRIPT_NAME}?click_id={$i->getId()}'>{$i->getTitle()}</a> | </td>
                    <td>{$i->getPrice()} |</td>
                    <td>{$i->getSeller_name()} | </td> 
                    <td><a href='{$smarty.server.SCRIPT_NAME}?del_ad={$i->getId()}'>Удалить</a></td>
                </tr>
            {foreachelse} База объявлений пуста
            {/foreach}
        </table> 
            
{include file='footer_1.tpl'}    