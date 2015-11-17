<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for block-Sommaire.php 
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright � 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)index.php"',
'"(?<!/)modules.php\?name=AvantGo"',
'"(?<!/)modules.php\?name=Content"',
'"(?<!/)modules.php\?name=Downloads"',
'"(?<!/)modules.php\?name=PrivateDownloads"',
'"(?<!/)modules.php\?name=Encyclopedia"',
'"(?<!/)modules.php\?name=FAQ"',
'"(?<!/)modules.php\?name=Feedback"',
'"(?<!/)modules.php\?name=Forums"',
'"(?<!/)modules.php\?name=Journal"',
'"(?<!/)modules.php\?name=Members_List"',
'"(?<!/)modules.php\?name=News"',
'"(?<!/)modules.php\?name=Private_Messages"',
'"(?<!/)modules.php\?name=Recommend_Us"',
'"(?<!/)modules.php\?name=Reviews"',
'"(?<!/)modules.php\?name=Search"',
'"(?<!/)modules.php\?name=Statistics"',
'"(?<!/)modules.php\?name=Stories_Archive"',
'"(?<!/)modules.php\?name=Submit_News"',
'"(?<!/)modules.php\?name=Surveys"',
'"(?<!/)modules.php\?name=Topics"',
'"(?<!/)modules.php\?name=Top"',
'"(?<!/)modules.php\?name=Web_Links"',
'"(?<!/)modules.php\?name=Your_Account"',
'"(?<!/)modules.php\?name=Amazon"',
'"(?<!/)modules.php\?name=Calendar"',
'"(?<!/)modules.php\?name=Donations"',
'"(?<!/)modules.php\?name=Shopping_Cart"',
'"(?<!/)modules.php\?name=Banner_Ads"',
'"(?<!/)modules.php\?name=Shout_Box"',
'"(?<!/)modules.php\?name=Groups"',
'"(?<!/)modules.php\?name=NukeC30"',
'"(?<!/)modules.php\?name=Member_Application"',
'"(?<!/)modules.php\?name=SimpleCart"',
'"(?<!/)modules.php\?name=Whats_New"',
'"(?<!/)modules.php\?name=Docs"',
'"(?<!/)modules.php\?name=Tutorials"',
'"(?<!/)modules.php\?name=Universal"',
'"(?<!/)modules.php\?name=MetAuthors"',
'"(?<!/)modules.php\?name=Advertising"',
'"(?<!/)modules.php\?name=Work_Board"',
'"(?<!/)modules.php\?name=Contact"',
'"(?<!/)modules.php\?name=Work_Probe"',
'"(?<!/)modules.php\?name=Staff"',
'"(?<!/)modules.php\?name=Sitemap"',
'"(?<!/)modules.php\?name=Credits"',
'"(?<!/)modules.php\?name=HTML_Newsletter"',
'"(?<!/)modules.php\?name=Mailing_List"',
'"(?<!/)modules.php\?name=Ban_Request"',
'"(?<!/)modules.php\?name=PHP_Nuke_Tools"',
'"(?<!/)modules.php\?name=Work_Request"',
'"(?<!/)modules.php\?name=Supporters"',
'"(?<!/)modules.php\?name=Affiliates&amp;op=SPGo&amp;site_id=([0-9]*)"',
'"(?<!/)modules.php\?name=Affiliates&amp;op=SPSubmit"',
'"(?<!/)modules.php\?name=Affiliates"'

);

$urlout = array(
'home.html',
'avantgo.html',
'content.html',
'downloads.html',
'privatedownloads.html',
'encyclopedia.html',
'faq.html',
'feedback.html',
'forums.html',
'journal.html',
'members.html',
'news.html',
'messages.html',
'recommend.html',
'reviews.html',
'search.html',
'stats.html',
'archive.html',
'submit.html',
'surveys.html',
'topics.html',
'top.html',
'links.html',
'account.html',
'amazon-\\1.html',
'calendar.html',
'donations.html',
'shopping.html',
'bannerads.html',
'shouthistory.html',
'groups.html',
'adverts.html',
'application.html',
'simplecart.html',
'whatsnew.html',
'notice.html',
'tutorials.html',
'universal.html',
'metauthors.html',
'advertising.html',
'workboard.html',
'contact.html',
'workprobe.html',
'staff.html',
'sitemap.html',
'credits.html',
'newsletter.html',
'mailinglist.html',
'banrequest.html',
'tools.html',
'workrequest.html',
'supporters.html',
'affiliates-site\\1.html',
'affiliates-submit.html',
'affiliates.html'

);

?>