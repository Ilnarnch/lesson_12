<?php /* Smarty version 2.6.25-dev, created on 2015-11-21 17:33:17
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'index.tpl', 5, false),array('modifier', 'date_format', 'index.tpl', 41, false),array('function', 'html_select_date', 'index.tpl', 29, false),array('function', 'mailto', 'index.tpl', 31, false),array('function', 'html_options', 'index.tpl', 63, false),array('function', 'html_table', 'index.tpl', 66, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header_template']).".tpl", 'smarty_include_vars' => array('year' => '2015')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('time', '13:33'); ?>

привет, <?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 ,как дела
<br>
<?php if ($this->_tpl_vars['name'] == 'Ilnar'): ?>
    Мое имя Ильнар
<?php else: ?>
    Мое имя не Ильнар
<?php endif; ?>

<br>
текущее время <?php echo $this->_tpl_vars['time']; ?>

<br>

Имя сервера: <?php echo $_SERVER['SERVER_NAME']; ?>
 <br>
<?php if (isset ( $_GET['id'] )): ?>
ID = <?php echo $_GET['id']; ?>
<?php else: ?>
    ID = not get
<?php endif; ?>
<br>
Имя(ассоциативный):<?php echo $this->_tpl_vars['names']['first']; ?>

<br>
Имя0:<?php echo $this->_tpl_vars['names'][0]; ?>

<br>
<?php echo smarty_function_html_select_date(array('display_days' => true), $this);?>

<br>
<?php echo smarty_function_mailto(array('address' => '123@ya.ru'), $this);?>

<br>
Operation: <?php echo $this->_tpl_vars['raz']+$this->_tpl_vars['dva']; ?>

<br>
Contacts: <?php echo $this->_tpl_vars['Contacts']['phone']['cell']; ?>

<br>
i_massive : <?php echo $this->_tpl_vars['i_massive'][1]; ?>


<br>

time: <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>


<br>

time():<?php echo ((is_array($_tmp=$this->_tpl_vars['raz'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>


<ul>
    <?php $_from = $this->_tpl_vars['items_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['href'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['href']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['href']['iteration']++;
?>        <li><a href="item.php?id=<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['no']; ?>
:<?php echo $this->_tpl_vars['item']['label']; ?>
 | <?php echo $this->_foreach['href']['iteration']; ?>
 | <?php echo ($this->_foreach['href']['iteration'] <= 1); ?>
 </a></li>
    <?php endforeach; else: ?>
        Ничего не найдено
    <?php endif; unset($_from); ?>
     
</ul>
    
<br>

<?php 
    global $not_smarty;
    echo $not_smarty;
 ?>
<br>
<?php echo smarty_function_html_options(array('name' => 'customer_id','options' => $this->_tpl_vars['cust_options'],'selected' => $this->_tpl_vars['customer_id']), $this);?>

<br>

<?php echo smarty_function_html_table(array('loop' => $this->_tpl_vars['data'],'cols' => 'first,second,third,fourth','tr_attr' => $this->_tpl_vars['tr']), $this);?>

<br>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
