<?php

declare(strict_types=1);
/*======================================================================= 
  PHP-Nuke Platinum | Nuke-Evolution Xtreme | PHP-Nuke Titanium
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: RSS Functions 2.0
   ============================================
   Copyright (c) 2006 by The Nuke-Evolution Team

   Filename      : functions.php
   Author        : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 3.0.0
   Date          : 12/10/2006 (mm-dd-yyyy)

   Notes         : RSS functions 2.0
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mods]=-
      RSS Improvements                         v3.0.0       12/07/2006
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/* Decodes the rest of the text so it gets displayed properly - Beta 2 by Rodmar*/
function decode_rss_rest($text) {
    $text = preg_replace('%\[br\]%i', '<br />', $text);
    $text = preg_replace('%\[hr\]%i', '<hr />', $text);
    $text = preg_replace('%\[img *\](.*?)\.(gif|png|jpg|jpeg)\[/img *\]%i', '<img src="\1.\2" />', $text);
    $text = preg_replace('%\[code\]([^\[]*)\[/code\]%i', '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center" class="bodyline"><tr><td><span class="genmed"><strong>Code:</strong></span></td></tr><tr><td class="code"><code>\1</code></td></tr></table>', $text);
    $text = preg_replace('%\[php\]([^\[]*)\[/php\]%i', '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center" class="bodyline"><tr><td><span class="genmed"><strong>PHP:</strong></span></td></tr><tr><td class="code"><code>\1</code></td></tr></table>', $text);
    // NOTE: Does not work with FireFox and similar browsers
    $text = preg_replace('%\[marq=(down|left|right|up)\]([^\[]*)\[/marq\]%i', '<marquee direction="\1" scrolldelay="60" scrollamount="2">\2</marquee>', $text);
    return $text;
}

/* Entity to unicode hexadecimal value - Beta 2 by Rodmar */
/* This function will parse special characters to their hexadecimal equvivalent */
function entity_to_hex_value($string) {
    $entity_to_decimal = array(

        // Latin-1 Entities
        '&nbsp;' => '&#xA0;',
        '&iexcl;' => '&#xA1;',
        '&cent;' => '&#xA2;',
        '&pound;' => '&#xA3;',
        '&curren;' => '&#xA4;',
        '&yen;' => '&#xA5;',
        '&brvbar;' => '&#xA6;',
        '&sect;' => '&#xA7;',
        '&uml;' => '&#xA8;',
        '&copy;' => '&#xA9;',
        '&ordf;' => '&#xAA;',
        '&laquo;' => '&#xAB;',
        '&not;' => '&#xAC;',
        '&shy;' => '&#xAD;',
        '&reg;' => '&#xAE;',
        '&macr;' => '&#xAF;',
        '&deg;' => '&#xB0;',
        '&plusmn;' => '&#xB1;',
        '&sup2;' => '&#xB2;',
        '&sup3;' => '&#xB3;',
        '&acute;' => '&#xB4;',
        '&micro;' => '&#xB5;',
        '&para;' => '&#xB6;',
        '&middot;' => '&#xB7;',
        '&cedil;' => '&#xB8;',
        '&sup1;' => '&#xB9;',
        '&ordm;' => '&#xBA;',
        '&raquo;' => '&#xBB;',
        '&frac14;' => '&#xBC;',
        '&frac12;' => '&#xBD;',
        '&frac34;' => '&#xBE;',
        '&iquest;' => '&#xBF;',
        '&Agrave;' => '&#xC0;',
        '&Aacute;' => '&#xC1;',
        '&Acirc;' => '&#xC2;',
        '&Atilde;' => '&#xC3;',
        '&Auml;' => '&#xC4;',
        '&Aring;' => '&#xC5;',
        '&AElig;' => '&#xC6;',
        '&Ccedil;' => '&#xC7;',
        '&Egrave;' => '&#xC8;',
        '&Eacute;' => '&#xC9;',
        '&Ecirc;' => '&#xCA;',
        '&Euml;' => '&#xCB;',
        '&Igrave;' => '&#xCC;',
        '&Iacute;' => '&#xCD;',
        '&Icirc;' => '&#xCE;',
        '&Iuml;' => '&#xCF;',
        '&ETH;' => '&#xD0;',
        '&Ntilde;' => '&#xD1;',
        '&Ograve;' => '&#xD2;',
        '&Oacute;' => '&#xD3;',
        '&Ocirc;' => '&#xD4;',
        '&Otilde;' => '&#xD5;',
        '&Ouml;' => '&#xD6;',
        '&times;' => '&#xD7;',
        '&Oslash;' => '&#xD8;',
        '&Ugrave;' => '&#xD9;',
        '&Uacute;' => '&#xDA;',
        '&Ucirc;' => '&#xDB;',
        '&Uuml;' => '&#xDC;',
        '&Yacute;' => '&#xDD;',
        '&THORN;' => '&#xDE;',
        '&szlig;' => '&#xDF;',
        '&agrave;' => '&#xE0;',
        '&aacute;' => '&#xE1;',
        '&acirc;' => '&#xE2;',
        '&atilde;' => '&#xE3;',
        '&auml;' => '&#xE4;',
        '&aring;' => '&#xE5;',
        '&aelig;' => '&#xE6;',
        '&ccedil;' => '&#xE7;',
        '&egrave;' => '&#xE8;',
        '&eacute;' => '&#xE9;',
        '&ecirc;' => '&#xEA;',
        '&euml;' => '&#xEB;',
        '&igrave;' => '&#xEC;',
        '&iacute;' => '&#xED;',
        '&icirc;' => '&#xEE;',
        '&iuml;' => '&#xEF;',
        '&eth;' => '&#xF0;',
        '&ntilde;' => '&#xF1;',
        '&ograve;' => '&#xF2;',
        '&oacute;' => '&#xF3;',
        '&ocirc;' => '&#xF4;',
        '&otilde;' => '&#xF5;',
        '&ouml;' => '&#xF6;',
        '&divide;' => '&#xF7;',
        '&oslash;' => '&#xF8;',
        '&ugrave;' => '&#xF9;',
        '&uacute;' => '&#xFA;',
        '&ucirc;' => '&#xFB;',
        '&uuml;' => '&#xFC;',
        '&yacute;' => '&#xFD;',
        '&thorn;' => '&#xFE;',
        '&yuml;' => '&#xFF;',

        // Entities for Symbols and Greek Letters
        '&fnof;' => '&#x192;',
        '&Alpha;' => '&#x391;',
        '&Beta;' => '&#x392;',
        '&Gamma;' => '&#x393;',
        '&Delta;' => '&#x394;',
        '&Epsilon;' => '&#x395;',
        '&Zeta;' => '&#x396;',
        '&Eta;' => '&#x397;',
        '&Theta;' => '&#x398;',
        '&Iota;' => '&#x399;',
        '&Kappa;' => '&#x39A;',
        '&Lambda;' => '&#x39B;',
        '&Mu;' => '&#x39C;',
        '&Nu;' => '&#x39D;',
        '&Xi;' => '&#x39E;',
        '&Omicron;' => '&#x39F;',
        '&Pi;' => '&#x3A0;',
        '&Rho;' => '&#x3A1;',
        '&Sigma;' => '&#x3A3;',
        '&Tau;' => '&#x3A4;',
        '&Upsilon;' => '&#x3A5;',
        '&Phi;' => '&#x3A6;',
        '&Chi;' => '&#x3A7;',
        '&Psi;' => '&#x3A8;',
        '&Omega;' => '&#x3A9;',
        '&alpha;' => '&#x3B1;',
        '&beta;' => '&#x3B2;',
        '&gamma;' => '&#x3B3;',
        '&delta;' => '&#x3B4;',
        '&epsilon;' => '&#x3B5;',
        '&zeta;' => '&#x3B6;',
        '&eta;' => '&#x3B7;',
        '&theta;' => '&#x3B8;',
        '&iota;' => '&#x3B9;',
        '&kappa;' => '&#x3BA;',
        '&lambda;' => '&#x3BB;',
        '&mu;' => '&#x3BC;',
        '&nu;' => '&#x3BD;',
        '&xi;' => '&#x3BE;',
        '&omicron;' => '&#x3BF;',
        '&pi;' => '&#x3C0;',
        '&rho;' => '&#x3C1;',
        '&sigmaf;' => '&#x3C2;',
        '&sigma;' => '&#x3C3;',
        '&tau;' => '&#x3C4;',
        '&upsilon;' => '&#x3C5;',
        '&phi;' => '&#x3C6;',
        '&chi;' => '&#x3C7;',
        '&psi;' => '&#x3C8;',
        '&omega;' => '&#x3C9;',
        '&thetasym;' => '&#x3D1;',
        '&upsih;' => '&#x3D2;',
        '&piv;' => '&#x3D6;',
        '&bull;' => '&#x2022;',
        '&hellip;' => '&#x2026;',
        '&prime;' => '&#x2032;',
        '&Prime;' => '&#x2033;',
        '&oline;' => '&#x203E;',
        '&frasl;' => '&#x2044;',
        '&weierp;' => '&#x2118;',
        '&image;' => '&#x2111;',
        '&real;' => '&#x211C;',
        '&trade;' => '&#x2122;',
        '&alefsym;' => '&#x2135;',
        '&larr;' => '&#x2190;',
        '&uarr;' => '&#x2191;',
        '&rarr;' => '&#x2192;',
        '&darr;' => '&#x2193;',
        '&harr;' => '&#x2194;',
        '&crarr;' => '&#x21B5;',
        '&lArr;' => '&#x21D0;',
        '&uArr;' => '&#x21D1;',
        '&rArr;' => '&#x21D2;',
        '&dArr;' => '&#x21D3;',
        '&hArr;' => '&#x21D4;',
        '&forall;' => '&#x2200;',
        '&part;' => '&#x2202;',
        '&exist;' => '&#x2203;',
        '&empty;' => '&#x2205;',
        '&nabla;' => '&#x2207;',
        '&isin;' => '&#x2208;',
        '&notin;' => '&#x2209;',
        '&ni;' => '&#x220B;',
        '&prod;' => '&#x220F;',
        '&sum;' => '&#x2211;',
        '&minus;' => '&#x2212;',
        '&lowast;' => '&#x2217;',
        '&radic;' => '&#x221A;',
        '&prop;' => '&#x221D;',
        '&infin;' => '&#x221E;',
        '&ang;' => '&#x2220;',
        '&and;' => '&#x2227;',
        '&or;' => '&#x2228;',
        '&cap;' => '&#x2229;',
        '&cup;' => '&#x222A;',
        '&int;' => '&#x222B;',
        '&there4;' => '&#x2234;',
        '&sim;' => '&#x223C;',
        '&cong;' => '&#x2245;',
        '&asymp;' => '&#x2248;',
        '&ne;' => '&#x2260;',
        '&equiv;' => '&#x2261;',
        '&le;' => '&#x2264;',
        '&ge;' => '&#x2265;',
        '&sub;' => '&#x2282;',
        '&sup;' => '&#x2283;',
        '&nsub;' => '&#x2284;',
        '&sube;' => '&#x2286;',
        '&supe;' => '&#x2287;',
        '&oplus;' => '&#x2295;',
        '&otimes;' => '&#x2297;',
        '&perp;' => '&#x22A5;',
        '&sdot;' => '&#x22C5;',
        '&lceil;' => '&#x2308;',
        '&rceil;' => '&#x2309;',
        '&lfloor;' => '&#x230A;',
        '&rfloor;' => '&#x230B;',
        '&lang;' => '&#x2329;',
        '&rang;' => '&#x232A;',
        '&loz;' => '&#x25CA;',
        '&spades;' => '&#x2660;',
        '&clubs;' => '&#x2663;',
        '&hearts;' => '&#x2665;',
        '&diams;' => '&#x2666;',

        // Special Entities
        '&quot;' => '&#x22;',
        '&amp;' => '&#x26;',
        '&lt;' => '&#x3C;',
        '&gt;' => '&#x3E;',
        '&OElig;' => '&#x152;',
        '&oelig;' => '&#x153;',
        '&Scaron;' => '&#x160;',
        '&scaron;' => '&#x161;',
        '&Yuml;' => '&#x178;',
        '&circ;' => '&#x2C6;',
        '&tilde;' => '&#x2DC;',
        '&ensp;' => '&#x2002;',
        '&emsp;' => '&#x2003;',
        '&thinsp;' => '&#x2009;',
        '&zwnj;' => '&#x200C;',
        '&zwj;' => '&#x200D;',
        '&lrm;' => '&#x200E;',
        '&rlm;' => '&#x200F;',
        '&ndash;' => '&#x2013;',
        '&mdash;' => '&#x2014;',
        '&lsquo;' => '&#x2018;',
        '&rsquo;' => '&#x2019;',
        '&sbquo;' => '&#x201A;',
        '&ldquo;' => '&#x201C;',
        '&rdquo;' => '&#x201D;',
        '&bdquo;' => '&#x201E;',
        '&dagger;' => '&#x2020;',
        '&Dagger;' => '&#x2021;',
        '&permil;' => '&#x2030;',
        '&lsaquo;' => '&#x2039;',
        '&rsaquo;' => '&#x203A;',
        '&euro;' => '&#x20AC;'
    );

    return preg_replace("/&[A-Za-z]+;/", " ", strtr($string, $entity_to_decimal));

}

/* Entity to unicode decimal value */
/* This function will parse special characters to their decimal equvivalent */
// UNUSED FUNCTION: Might be implemented later on again
/*function entity_to_decimal_value($string) {
    $entity_to_decimal = array(

        // Latin-1 Entities
        '&nbsp;' => '&#160;',
        '&iexcl;' => '&#161;',
        '&cent;' => '&#162;',
        '&pound;' => '&#163;',
        '&curren;' => '&#164;',
        '&yen;' => '&#165;',
        '&brvbar;' => '&#166;',
        '&sect;' => '&#167;',
        '&uml;' => '&#168;',
        '&copy;' => '&#169;',
        '&ordf;' => '&#170;',
        '&laquo;' => '&#171;',
        '&not;' => '&#172;',
        '&shy;' => '&#173;',
        '&reg;' => '&#174;',
        '&macr;' => '&#175;',
        '&deg;' => '&#176;',
        '&plusmn;' => '&#177;',
        '&sup2;' => '&#178;',
        '&sup3;' => '&#179;',
        '&acute;' => '&#180;',
        '&micro;' => '&#181;',
        '&para;' => '&#182;',
        '&middot;' => '&#183;',
        '&cedil;' => '&#184;',
        '&sup1;' => '&#185;',
        '&ordm;' => '&#186;',
        '&raquo;' => '&#187;',
        '&frac14;' => '&#188;',
        '&frac12;' => '&#189;',
        '&frac34;' => '&#190;',
        '&iquest;' => '&#191;',
        '&Agrave;' => '&#192;',
        '&Aacute;' => '&#193;',
        '&Acirc;' => '&#194;',
        '&Atilde;' => '&#195;',
        '&Auml;' => '&#196;',
        '&Aring;' => '&#197;',
        '&AElig;' => '&#198;',
        '&Ccedil;' => '&#199;',
        '&Egrave;' => '&#200;',
        '&Eacute;' => '&#201;',
        '&Ecirc;' => '&#202;',
        '&Euml;' => '&#203;',
        '&Igrave;' => '&#204;',
        '&Iacute;' => '&#205;',
        '&Icirc;' => '&#206;',
        '&Iuml;' => '&#207;',
        '&ETH;' => '&#208;',
        '&Ntilde;' => '&#209;',
        '&Ograve;' => '&#210;',
        '&Oacute;' => '&#211;',
        '&Ocirc;' => '&#212;',
        '&Otilde;' => '&#213;',
        '&Ouml;' => '&#214;',
        '&times;' => '&#215;',
        '&Oslash;' => '&#216;',
        '&Ugrave;' => '&#217;',
        '&Uacute;' => '&#218;',
        '&Ucirc;' => '&#219;',
        '&Uuml;' => '&#220;',
        '&Yacute;' => '&#221;',
        '&THORN;' => '&#222;',
        '&szlig;' => '&#223;',
        '&agrave;' => '&#224;',
        '&aacute;' => '&#225;',
        '&acirc;' => '&#226;',
        '&atilde;' => '&#227;',
        '&auml;' => '&#228;',
        '&aring;' => '&#229;',
        '&aelig;' => '&#230;',
        '&ccedil;' => '&#231;',
        '&egrave;' => '&#232;',
        '&eacute;' => '&#233;',
        '&ecirc;' => '&#234;',
        '&euml;' => '&#235;',
        '&igrave;' => '&#236;',
        '&iacute;' => '&#237;',
        '&icirc;' => '&#238;',
        '&iuml;' => '&#239;',
        '&eth;' => '&#240;',
        '&ntilde;' => '&#241;',
        '&ograve;' => '&#242;',
        '&oacute;' => '&#243;',
        '&ocirc;' => '&#244;',
        '&otilde;' => '&#245;',
        '&ouml;' => '&#246;',
        '&divide;' => '&#247;',
        '&oslash;' => '&#248;',
        '&ugrave;' => '&#249;',
        '&uacute;' => '&#250;',
        '&ucirc;' => '&#251;',
        '&uuml;' => '&#252;',
        '&yacute;' => '&#253;',
        '&thorn;' => '&#254;',
        '&yuml;' => '&#255;',

        // Entities for Symbols and Greek Letters
        '&fnof;' => '&#402;',
        '&Alpha;' => '&#913;',
        '&Beta;' => '&#914;',
        '&Gamma;' => '&#915;',
        '&Delta;' => '&#916;',
        '&Epsilon;' => '&#917;',
        '&Zeta;' => '&#918;',
        '&Eta;' => '&#919;',
        '&Theta;' => '&#920;',
        '&Iota;' => '&#921;',
        '&Kappa;' => '&#922;',
        '&Lambda;' => '&#923;',
        '&Mu;' => '&#924;',
        '&Nu;' => '&#925;',
        '&Xi;' => '&#926;',
        '&Omicron;' => '&#927;',
        '&Pi;' => '&#928;',
        '&Rho;' => '&#929;',
        '&Sigma;' => '&#931;',
        '&Tau;' => '&#932;',
        '&Upsilon;' => '&#933;',
        '&Phi;' => '&#934;',
        '&Chi;' => '&#935;',
        '&Psi;' => '&#936;',
        '&Omega;' => '&#937;',
        '&alpha;' => '&#945;',
        '&beta;' => '&#946;',
        '&gamma;' => '&#947;',
        '&delta;' => '&#948;',
        '&epsilon;' => '&#949;',
        '&zeta;' => '&#950;',
        '&eta;' => '&#951;',
        '&theta;' => '&#952;',
        '&iota;' => '&#953;',
        '&kappa;' => '&#954;',
        '&lambda;' => '&#955;',
        '&mu;' => '&#956;',
        '&nu;' => '&#957;',
        '&xi;' => '&#958;',
        '&omicron;' => '&#959;',
        '&pi;' => '&#960;',
        '&rho;' => '&#961;',
        '&sigmaf;' => '&#962;',
        '&sigma;' => '&#963;',
        '&tau;' => '&#964;',
        '&upsilon;' => '&#965;',
        '&phi;' => '&#966;',
        '&chi;' => '&#967;',
        '&psi;' => '&#968;',
        '&omega;' => '&#969;',
        '&thetasym;' => '&#977;',
        '&upsih;' => '&#978;',
        '&piv;' => '&#982;',
        '&bull;' => '&#8226;',
        '&hellip;' => '&#8230;',
        '&prime;' => '&#8242;',
        '&Prime;' => '&#8243;',
        '&oline;' => '&#8254;',
        '&frasl;' => '&#8260;',
        '&weierp;' => '&#8472;',
        '&image;' => '&#8465;',
        '&real;' => '&#8476;',
        '&trade;' => '&#8482;',
        '&alefsym;' => '&#8501;',
        '&larr;' => '&#8592;',
        '&uarr;' => '&#8593;',
        '&rarr;' => '&#8594;',
        '&darr;' => '&#8595;',
        '&harr;' => '&#8596;',
        '&crarr;' => '&#8629;',
        '&lArr;' => '&#8656;',
        '&uArr;' => '&#8657;',
        '&rArr;' => '&#8658;',
        '&dArr;' => '&#8659;',
        '&hArr;' => '&#8660;',
        '&forall;' => '&#8704;',
        '&part;' => '&#8706;',
        '&exist;' => '&#8707;',
        '&empty;' => '&#8709;',
        '&nabla;' => '&#8711;',
        '&isin;' => '&#8712;',
        '&notin;' => '&#8713;',
        '&ni;' => '&#8715;',
        '&prod;' => '&#8719;',
        '&sum;' => '&#8721;',
        '&minus;' => '&#8722;',
        '&lowast;' => '&#8727;',
        '&radic;' => '&#8730;',
        '&prop;' => '&#8733;',
        '&infin;' => '&#8734;',
        '&ang;' => '&#8736;',
        '&and;' => '&#8743;',
        '&or;' => '&#8744;',
        '&cap;' => '&#8745;',
        '&cup;' => '&#8746;',
        '&int;' => '&#8747;',
        '&there4;' => '&#8756;',
        '&sim;' => '&#8764;',
        '&cong;' => '&#8773;',
        '&asymp;' => '&#8776;',
        '&ne;' => '&#8800;',
        '&equiv;' => '&#8801;',
        '&le;' => '&#8804;',
        '&ge;' => '&#8805;',
        '&sub;' => '&#8834;',
        '&sup;' => '&#8835;',
        '&nsub;' => '&#8836;',
        '&sube;' => '&#8838;',
        '&supe;' => '&#8839;',
        '&oplus;' => '&#8853;',
        '&otimes;' => '&#8855;',
        '&perp;' => '&#8869;',
        '&sdot;' => '&#8901;',
        '&lceil;' => '&#8968;',
        '&rceil;' => '&#8969;',
        '&lfloor;' => '&#8970;',
        '&rfloor;' => '&#8971;',
        '&lang;' => '&#9001;',
        '&rang;' => '&#9002;',
        '&loz;' => '&#9674;',
        '&spades;' => '&#9824;',
        '&clubs;' => '&#9827;',
        '&hearts;' => '&#9829;',
        '&diams;' => '&#9830;',

        // Special Entities
        '&quot;' => '&#34;',
        '&amp;' => '&#38;',
        '&lt;' => '&#60;',
        '&gt;' => '&#62;',
        '&OElig;' => '&#338;',
        '&oelig;' => '&#339;',
        '&Scaron;' => '&#352;',
        '&scaron;' => '&#353;',
        '&Yuml;' => '&#376;',
        '&circ;' => '&#710;',
        '&tilde;' => '&#732;',
        '&ensp;' => '&#8194;',
        '&emsp;' => '&#8195;',
        '&thinsp;' => '&#8201;',
        '&zwnj;' => '&#8204;',
        '&zwj;' => '&#8205;',
        '&lrm;' => '&#8206;',
        '&rlm;' => '&#8207;',
        '&ndash;' => '&#8211;',
        '&mdash;' => '&#8212;',
        '&lsquo;' => '&#8216;',
        '&rsquo;' => '&#8217;',
        '&sbquo;' => '&#8218;',
        '&ldquo;' => '&#8220;',
        '&rdquo;' => '&#8221;',
        '&bdquo;' => '&#8222;',
        '&dagger;' => '&#8224;',
        '&Dagger;' => '&#8225;',
        '&permil;' => '&#8240;',
        '&lsaquo;' => '&#8249;',
        '&rsaquo;' => '&#8250;',
        '&euro;' => '&#8364;'
    );

    return preg_replace("/&[A-Za-z]+;/", " ", strtr($string, $entity_to_decimal));

}*/

/* Shortens the length of the feed to 500 characters and replaces the rest with ... */
// UNUSED FUNCTION: Might be implemented later on again
/*function doti($str, $len = 500, $dots = "...") {
    // $len=max length of hometext displayed
    if(strlen($str) > $len) {
        // $dot = " whatever you want here ")
        $str = explode(".", $str);
        // Displayed at the end of hometext
        $dotlen = strlen($dots);
        $str = substr_replace($str[0].$str[1].$str[2].$str[3].$str[4], $dots, $len - $dotlen);
    }
    return $str;
}*/
