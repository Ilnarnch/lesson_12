<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');

?>
<form  method="post" action = "<?php echo $_SERVER['PHP_SELF'] ?>" name = "form_1">
        <h2><?php echo $formParams['head'] ?> </h2>
            <div class="form-row-indented"> 
                <label class="form-label-radio">
                    <input type="radio"
                        <?php
                            if ($formParams['private'] == 1)
                                { 
                                    echo 'checked=""';
                                } 
                        ?> 
                        value="1" name="private">Частное лицо</label>
                <label class="form-label-radio">
                    <input type="radio" 
                        <?php 
                            if ($formParams['private'] == 0)
                                {
                                    echo 'checked=""';
                                }  
                         ?>  
                        value="0" name="private">Компания</label> 
            </div>
            <div class="form-row"> <label for="fld_seller_name" class="form-label"><b id="your-name">Ваше имя</b></label>
            <input type="text" maxlength="40" class="form-input-text" value="<?php echo $formParams['seller_name'] ?>" name="seller_name" id="fld_seller_name">
        </div>
   
        <div class="form-row"> <label for="fld_email" class="form-label">Электронная почта</label>
            <input type="text" class="form-input-text" value="<?php echo $formParams['email'] ?>" name="email" id="fld_email">
        </div>

    
        <div class="form-row"> <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label> 
            <input type="text" class="form-input-text" value="<?php echo $formParams['phone'] ?>" name="phone" id="fld_phone">
        </div>
    
     
        <div id="f_location_id" class="form-row form-row-required"> <label for="region" class="form-label">Город</label> 
            <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">
                <option value="">-- Выберите город --</option>
                <option class="opt-group" disabled="disabled">-- Города --</option>
                    <?php
                        foreach ($cities as $number => $city)
                            {
                                echo '<option data-coords= ",," value="' . $number . '"';
                                    if ($city == $formParams['location_id'])
                                        {
                                            echo 'selected';
                                        }
                                    echo '>' . $city . '</option>';
                            }
                    ?>
           
            </select>
   
            <div id="f_checkbox"> 
                <p> Получать рассылку? </p>
                <p><input type = "checkbox" name="checkbox" value="Yes"<?php if ($formParams['checkbox'] == 'Yes'){ echo 'checked';}?>> Да</p>
                <!--<p><input type = "checkbox" name="checkbox" value="No"<?php if ($formParams['checkbox'] == 'No'){ echo 'checked';}?>> Нет</p>-->
            </div> 
        </div>

        <div class="form-row"> <label for="fld_category_id" class="form-label">Категория</label> 
            <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select"> 
                <option value="">-- Выберите категорию --</option>
                    <?php
                        foreach ($categories as $section => $category)
                            {
                                echo '<optgroup label = "'. $section .'">';
                    
                                    foreach ($category as $number => $value)
                                        {
                                            echo '<option value="' . $number . '"';
                                                if ($number == $formParams['category_id'])
                                                    {
                                                        echo 'selected';
                                                    }
                                                echo '>' . $value . '</option>';
                                        }
                                    echo                   
                                        '</optgroup>';
                            }
                    ?>
            </select> 
        </div>

        <div id="f_title" class="form-row f_title"> 
            <label for="fld_title" class="form-label">Название объявления</label> 
            <input type="text" maxlength="50" class="form-input-text-long" value="<?php echo $formParams['title']?>" name="title" id="fld_title"> 
        </div>

        <div class="form-row"> 
            <label for="fld_description" class="form-label" id="js-description-label">Описание объявления</label> 
            <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"><?php echo $formParams['description'] ?></textarea> 
        </div>

        <div id="price_rw" class="form-row rl"> 
            <label id="price_lbl" for="fld_price" class="form-label">Цена</label> 
            <input type="text" maxlength="9" class="form-input-text-short" value="<?php echo $formParams['price'] ?>" name="price" id="fld_price">&nbsp;<span id="fld_price_title">руб.
        </div>

        <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
            <div class="vas-submit-button pull-left"> <span class="vas-submit-border"></span> <span class="vas-submit-triangle"></span> <input type="submit" value="<?php echo $formParams['button'] ?>" id="form_submit" name="main_form_submit" class="vas-submit-input"> </div>
        </div>
        <input type="hidden" name="hidden" value="<?php if(isset($id)){echo $id;}  ?>">
    </form>