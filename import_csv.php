<?php
/**
 * Copyright (C) 2005, 2006, 2007, 2008  Brice Burgess <bhb@iceburg.net>
 * 
 * This file is part of poMMo (http://www.pommo.org)
 * 
 * poMMo is free software; you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published 
 * by the Free Software Foundation; either version 2, or any later version.
 * 
 * poMMo is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See
 * the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with program; see the file docs/LICENSE. If not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
 */
 
 /**********************************
	INITIALIZATION METHODS
 *********************************/
require ('bootstrap.php');
require_once(Pommo::$_baseDir.'classes/Pommo_Csv_Stream.php');
require_once(Pommo::$_baseDir.'classes/Pommo_Subscribers.php');
require_once(Pommo::$_baseDir.'classes/Pommo_Fields.php');

Pommo::init(array('keep' => TRUE));
$logger = & Pommo::$_logger;
$dbo = & Pommo::$_dbo;

/**********************************
	SETUP TEMPLATE, PAGE
 *********************************/
require_once(Pommo::$_baseDir.'classes/Pommo_Template.php');
$smarty = new Pommo_Template();
$smarty->assign('returnStr',Pommo::_T('Import'));

$preview = Pommo::get('preview');

// find the most columns in a row
$cols = 0;
foreach($preview as $row) {
	$c = count($row);
	if($c > $cols)
		$cols = $c;
}


$smarty->assign('excludeUnsubscribed',(isset($_REQUEST['excludeUnsubscribed'])?true:false));
$smarty->assign('preview',$preview);
$smarty->assign('colNum',$cols);
$smarty->assign('fields',Pommo_Fields::get());

$smarty->display('admin/subscribers/import_csv.tpl');
Pommo::kill();
?>