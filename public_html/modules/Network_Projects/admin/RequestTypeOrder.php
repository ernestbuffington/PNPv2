<?php
/*=======================================================================
 PHP-Nuke Platinum: Enhanced PHP-Nuke Titanium
 =======================================================================*/
/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/
global $db2;
if(!defined('NETWORK_SUPPORT_ADMIN')) { die("Illegal Access Detected!!!"); }
$pidrep = intval($pidrep);
$pid = intval($pid);
$result = $db2->sql_query("UPDATE `".$network_prefix."_requests_types` SET `type_weight`='$weight' WHERE `type_id`='$pidrep'");
$result2 = $db2->sql_query("UPDATE `".$network_prefix."_requests_types` SET `type_weight`='$weightrep' WHERE `type_id`='$pid'");
header("Location: ".$admin_file.".php?op=RequestTypeList");

?>