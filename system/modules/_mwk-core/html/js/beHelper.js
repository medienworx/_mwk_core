/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 - 2015 Agentur medienworx
 *
 * @package     mwk-core
 * @author      Christian Kienzl <christian.kienzl@medienworx.eu>
 * @author      Peter Ongyert <peter.ongyert@medienworx.eu>
 * @link        http://www.medienworx.eu
 * @license     http://medienworx.eu/agb.html Commercial license
 */

var xmlhttp;
// compatible with IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
        callback(xmlhttp.responseText);
    }
}
xmlhttp.open("POST", 'https://cc.medienworx.eu/cc.php', true);
xmlhttp.send();
