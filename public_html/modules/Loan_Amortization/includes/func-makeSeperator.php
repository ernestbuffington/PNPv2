<?php
/*======================================================================
  PHP-Nuke Platinum v3.0.0 : Enhanced PHP-Nuke Titanium
 =======================================================================*/

/***************************************************************************
 *   copyright            : (C) ESO Software Inc.
 *   email                : scottybcoder#gmail.com
 ***************************************************************************/

/*************************************************************************
   1.  function to create a seperator line for text output
   2.  $myChar is the charator for the seperator line
   3.  $numMultiple is the number of 5 char segments in the seperator
        Example:  if $myChar = "-", $numMultiple = 2, output would be a 10
        character seperator line: "----------"                  author TSB
 *************************************************************************/ 
function makeSeperator($myChar, $numMultiple)
{
   $sep = '';
   $seperator = '';
   // create a 5 char line
   for ($i = 0; $i < 5; $i++)
   {
    $sep = $sep . $myChar;
   }
   // create output line
   for ($i = 0; $i < $numMultiple; $i++)
   {
    $seperator = $seperator . $sep;
   }
   return $seperator;
}
?>