 <!DOCTYPE html>
  
 <html lang="en">
 
     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1" >
         
         <title>DZ_12</title>
         <!--Bootstrap-->
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
     </head> 
     
     <form class="form-horizontal" method="POST" role="form" >
{*         <input type="hidden" name="id" value="1">*}
        <h2>Доска объявлений</h2>
        
        <div class="col-sm-offset-1 col-sm-11">    
         <div class="form-group">    
            <div class="radio">
                <label>
                    <input type="radio" name="type" id="optionsRadios1" value="0" checked="" {if $ad_c->getType() eq 0}checked{/if}>
                    Частное лицо
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="type" id="optionsRadios2" value="1" {if $ad_c->getType() eq 1}checked{/if}>
                    Компания
                </label>
            </div>
         </div>     
        </div>
        
        <div class="form-group">
             <label for="seller_name" class="col-sm-1 control-label">Ваше имя</label>
             <div class="col-sm-4">
                 <input type="text" name="seller_name" class="form-control" id="seller_name" placeholder="Ваше имя" value="{$ad_c->getSellerNname()}">
             </div>
         </div>
        
        <div class="form-group">
             <label for="email" class="col-sm-1 control-label">Электронная почта</label>
             <div class="col-sm-4">
                 <input type="text" name="email" class="form-control" id="email" placeholder="Электронная почта" value= "{$ad_c->getEmail()}">
             </div>
        </div>
        
        <div class="form-group">
             <label for="phone" class="col-sm-1 control-label">Номер телефона</label>
             <div class="col-sm-4">
                 <input type="text" name="phone" class="form-control" id="phone" placeholder="Номер телефона" value="{$ad_c->getPhone()}">
             </div>
        </div>
        
        <div class="form-group">
            <label for="city_id" class="col-sm-1 control-label">Город</label>
            {html_options name=city_id options=$cities selected=$ad_c->getCityId()}
        </div>
        
        <div class="form-group">
            <label for="allow_mail" class="col-sm-1 control-label"> Получать рассылку?</label>
            <div class="checkbox">
            <label>
              <input type="checkbox" name="allow_mail" value="Yes" {if $ad_c->getAllowMail() eq 'Yes'}checked{/if}>
                Да
            </label>
        </div>
        </div>
        
        <div class="form-group">
            <label for="fld_category_id" class="col-sm-1 control-label">Категория</label> 
            {html_options name=category_id options=$categories selected=$ad_c->getCategoryId()}
        </div> 

         <div class="form-group">
             <label for="inputEmail3" class="col-sm-1 control-label">Название</label>
             <div class="col-sm-4">
                 <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Название" value="{$ad_c->getName()}">
             </div>
         </div>
        
        <div class="form-group">
             <label for="price" class="col-sm-1 control-label">Цена</label>
             <div class="col-sm-4">
                 <input type="text" name="price" class="form-control" id="price" placeholder="Цена" value="{$ad_c->getPrice()}">
             </div>
        </div>  
        
        <div class="form-group">
            <label for="desc" class="col-sm-1 control-label">Описание</label>
            <div class="col-sm-4">
                <textarea name="desc" class="form-control" rows="3" >{$ad_c->getDesc()}</textarea>
            </div>
            
        <input type="hidden" name="id_c" value="{if isset($ad_c)}{$ad_c->getId()}{/if}">
  
   
{*             <div class="col-sm-offset-1 col-sm-10">
                 <button type="submit" class="btn btn-default">Отправить</button>
             </div>*}
         </div>    
   
    <div class="col-sm-offset-1 col-sm-10">
        <button type="submit" class="btn btn-default">{if isset($smarty.get.id_c)}Сохранить{else}Добавить{/if} объявление </button>
    </div>
    
    <div class="col-sm-offset-1 col-sm-10">
        {if isset($smarty.get.id_c)}<button type="submit" name="back" class="btn btn-default">Назад</button>{/if} 
    </div>
     </form> 
    {include file='table.tpl'}