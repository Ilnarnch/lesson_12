    <form  method="post" action = "{$smarty.server.PHP_SELF}" name = "form_1">
        <h2>{$smartyParams.formParams.head} </h2>
            <div class="form-row-indented"> 
                <label class="form-label-radio">
                    {html_radios name="private" options=$smartyParams.for_radios selected=$smartyParams.for_radios_checked separator="<br />"}
                </label>  
                
        <div class="form-row"> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="form-input-text" value="{$smartyParams.formParams.seller_name}" name="seller_name" id="fld_seller_name">
        </div>
   
        <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
            <input type="text" class="form-input-text" value= "{$smartyParams.formParams.email}" name="email" id="fld_email">
        </div>

    
        <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
            <input type="text" class="form-input-text" value="{$smartyParams.formParams.phone}" name="phone" id="fld_phone">
        </div>
    
        <div id="f_location_id" class="form-row form-row-required"> <label for="region" class="form-label">Город</label> 
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                
                    {foreach from = $smartyParams.cities key=number item=city}
                        <option data-coords= ",," value="{$number}"
                                {if $city == $smartyParams.formParams.location_id}
                                    selected
                                {/if}
                                >{$city} </option>;
                    {/foreach}
      
            </select>
    
            
            <div id="f_checkbox"> 
                <p> Получать рассылку? </p>
                <p><input type = "checkbox" name="checkbox" value="Yes" {if $smartyParams.formParams.checkbox == 'Yes'}checked{/if}> Да</p>
            </div> 
        </div>
                    

        <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> 
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                <option value="">-- Выберите категорию --</option>
           
                    {foreach from=$smartyParams.categories key=_section item=category}
                        <optgroup label = "{$_section}">
                    
                                    {foreach from = $category  key=number item=value}
                                        
                                            <option value="{$number}"
                                                {if $number == $smartyParams.formParams.category_id}
                                                    
                                                        selected
                                                    
                                                    {/if}
                                                > {$value}  </option>
                                        
                                        {/foreach}
                                        </optgroup>
                    {/foreach}
                    
            </select> 
        </div>
                                

        <div id="f_title" class="form-row f_title"> 
            <label for="fld_title" class="form-label">Название объявления</label> 
            <input type="text" maxlength="50" class="form-input-text-long" value="{$smartyParams.formParams.title}" name="title" id="fld_title"> 
        </div>

        <div class="form-row"> 
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
            <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea">{$smartyParams.formParams.description}</textarea> 
        </div>

        <div id="price_rw" class="form-row rl"> 
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label> 
            <input type="text" maxlength="9" class="form-input-text-short" value="{$smartyParams.formParams.price}" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.
        </div>

           
            
        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="{$smartyParams.formParams.button}" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
        </div>
            
            
            
        <input type="hidden" name="hidden" value="{if isset($smartyParams.id)}{$smartyParams.id}{/if}">
    </form>
    {if $smartyParams.formParams.head == 'Страница редактирования'}
        <a href="{$smarty.server.PHP_SELF}">Назад</a>
    {/if}
    
    {if !empty($smartyParams.adStore)}
        
        {if $smartyParams.formParams.head == 'Страница добавления объявления'}
            <table>
                {foreach from=$smartyParams.adStore  key=id item=idData}
                    <tr>
                        <td> <a href = "{$smarty.server.PHP_SELF}?id={$id}"> {$idData.title} </a> | </td> 	{*При нажатии на «название объявления» на экран выводится шаблон объявления *}
                        <td>  {$idData.price}  руб. | </td>
                        <td>  {$idData.seller_name}  | </td>
                        <td><a href = "{$smarty.server.PHP_SELF}?del={$id}">удалить</a><br></td>  {*При нажатии на «Удалить», объявление удаляется из файла*}
                    </tr> 
                    {/foreach}
            </table>
        {/if}
     
    {/if}