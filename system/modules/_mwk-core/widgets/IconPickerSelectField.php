<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 - 2015 Agentur medienworx
 *
 * @package     _mwk-core
 * @author      Christian Kienzl <christian.kienzl@medienworx.eu>
 * @author      Peter Ongyert <peter.ongyert@medienworx.eu>
 * @link        http://www.medienworx.eu
 * @license     http://medienworx.eu/agb.html Commercial license
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace medienworx;



/**
 * Class ModuleMwkIconPicker
 * @package medienworx
 */
class IconPickerSelectField extends \Widget
{

    /**
     * Submit user input
     * @var boolean
     */
    protected $blnSubmitInput = true;

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_widget';

    /**
     * Add specific attributes
     * @param string
     * @param mixed
     */
    public function __set($strKey, $varValue)
    {
        parent::__set($strKey, $varValue);
    }

    /**
     * Generate the widget and return it as string
     * @return string
     */
    public function generate()
    {
        
        $iconArray = array('new icons'=>array('bed','buysellads','cart-arrow-down','cart-plus','connectdevelop','dashcube','diamond','facebook-official','forumbee','heartbeat','leanpub','mars','mars-double','mars-stroke','mars-stroke-h','mars-stroke-v','medium','mercury','motorcycle','neuter','pinterest-p','sellsy','server','ship','shirtsinbulk','simplybuilt','skyatlas','street-view','subway','train','transgender','transgender-alt','user-plus','user-secret','user-times','venus','venus-double','venus-mars','viacoin','whatsapp'),'Web Application Icons' => array('adjust','anchor','archive','area-chart','arrows','arrows-h','arrows-v','asterisk','at','ban','bar-chart','barcode','bars','bed','beer','bell','bell-o','bell-slash','bell-slash-o','bicycle','binoculars','birthday-cake','bolt','bomb','book','bookmark','bookmark-o','briefcase','bug','building','building-o','bullhorn','bullseye','bus','calculator','calendar','calendar-o','camera','camera-retro','car','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','cart-arrow-down','cart-plus','cc','certificate','check','check-circle','check-circle-o','check-square','check-square-o','child','circle','circle-o','circle-o-notch','circle-thin','clock-o','cloud','cloud-download','cloud-upload','code','code-fork','coffee','cog','cogs','comment','comment-o','comments','comments-o','compass','copyright','credit-card','crop','crosshairs','cube','cubes','cutlery','database','desktop','diamond','dot-circle-o','download','ellipsis-h','ellipsis-v','envelope','envelope-o','envelope-square','eraser','exchange','exclamation','exclamation-circle','exclamation-triangle','external-link','external-link-square','eye','eye-slash','eyedropper','fax','female','fighter-jet','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-pdf-o','file-powerpoint-o','file-video-o','file-word-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flask','folder','folder-o','folder-open','folder-open-o','frown-o','futbol-o','gamepad','gavel','gift','glass','globe','graduation-cap','hdd-o','headphones','heart','heart-o','heartbeat','history','home','inbox','info','info-circle','key','keyboard-o','language','laptop','leaf','lemon-o','level-down','level-up','life-ring','lightbulb-o','line-chart','location-arrow','lock','magic','magnet','male','map-marker','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','money','moon-o','motorcycle','music','newspaper-o','paint-brush','paper-plane','paper-plane-o','paw','pencil','pencil-square','pencil-square-o','phone','phone-square','picture-o','pie-chart','plane','plug','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece','qrcode','question','question-circle','quote-left','quote-right','random','recycle','refresh','reply','reply-all','retweet','road','rocket','rss','rss-square','search','search-minus','search-plus','server','share','share-alt','share-alt-square','share-square','share-square-o','shield','ship','shopping-cart','sign-in','sign-out','signal','sitemap','sliders','smile-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-asc','sort-desc','sort-numeric-asc','sort-numeric-desc','space-shuttle','spinner','spoon','square','square-o','star','star-half','star-half-o','star-o','street-view','suitcase','sun-o','tablet','tachometer','tag','tags','tasks','taxi','terminal','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','toggle-off','toggle-on','trash','trash-o','tree','trophy','truck','tty','umbrella','university','unlock','unlock-alt','upload','user','user-plus','user-secret','user-times','users','video-camera','volume-down','volume-off','volume-up','wheelchair','wifi','wrench'),'Transportation Icons' => array('ambulance','bicycle','bus','car','fighter-jet','motorcycle','plane','rocket','ship','space-shuttle','subway','taxi','train','truck','wheelchair'),'Gender Icons' => array('circle-thin','mars','mars-double','mars-stroke','mars-stroke-h','mars-stroke-v','mercury','neuter','transgender','transgender-alt','venus','venus-double','venus-mars'),'File Type Icons' => array('file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-o','file-pdf-o','file-powerpoint-o','file-text','file-text-o','file-video-o','file-word-o'),'Spinner Icons' => array('circle-o-notch','cog','refresh','spinner'),'Form Control Icons' => array('check-square','check-square-o','circle','circle-o','dot-circle-o','minus-square','minus-square-o','plus-square','plus-square-o','square','square-o'),'Payment Icons' => array('cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','credit-card','google-wallet','paypal'),'Chart Icons' => array('area-chart','bar-chart','line-chart','pie-chart'),'Currency Icons' => array('btc','eur','gbp','ils','inr','jpy','krw','money','rub','try','usd'),'Text Editor Icons' => array('align-center','align-justify','align-left','align-right','bold','chain-broken','clipboard','columns','eraser','file','file-o','file-text','file-text-o','files-o','floppy-o','font','header','indent','italic','link','list','list-alt','list-ol','list-ul','outdent','paperclip','paragraph','repeat','scissors','strikethrough','subscript','superscript','table','text-height','text-width','th','th-large','th-list','underline','undo'),'Directional Icons' => array('angle-double-down','angle-double-left','angle-double-right','angle-double-up','angle-down','angle-left','angle-right','angle-up','arrow-circle-down','arrow-circle-left','arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-circle-right','arrow-circle-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','caret-down','caret-left','caret-right','caret-square-o-down','caret-square-o-left','caret-square-o-right','caret-square-o-up','caret-up','chevron-circle-down','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-down','chevron-left','chevron-right','chevron-up','hand-o-down','hand-o-left','hand-o-right','hand-o-up','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up'),'Video Player Icons' => array('arrows-alt','backward','compress','eject','expand','fast-backward','fast-forward','forward','pause','play','play-circle','play-circle-o','step-backward','step-forward','stop','youtube-play'),'Brand Icons' => array('adn','android','angellist','apple','behance','behance-square','bitbucket','bitbucket-square','btc','buysellads','cc-amex','cc-discover','cc-mastercard','cc-paypal','cc-stripe','cc-visa','codepen','connectdevelop','css3','dashcube','delicious','deviantart','digg','dribbble','dropbox','drupal','empire','facebook','facebook-official','facebook-square','flickr','forumbee','foursquare','git','git-square','github','github-alt','github-square','google','google-plus','google-plus-square','google-wallet','gratipay','hacker-news','html5','instagram','ioxhost','joomla','jsfiddle','lastfm','lastfm-square','leanpub','linkedin','linkedin-square','linux','maxcdn','meanpath','medium','openid','pagelines','paypal','pied-piper','pied-piper-alt','pinterest','pinterest-p','pinterest-square','qq','rebel','reddit','reddit-square','renren','sellsy','share-alt','share-alt-square','shirtsinbulk','simplybuilt','skyatlas','skype','slack','slideshare','soundcloud','spotify','stack-exchange','stack-overflow','steam','steam-square','stumbleupon','stumbleupon-circle','tencent-weibo','trello','tumblr','tumblr-square','twitch','twitter','twitter-square','viacoin','vimeo-square','vine','vk','weibo','weixin','whatsapp','windows','wordpress','xing','xing-square','yahoo','yelp','youtube','youtube-play','youtube-square'),'Medical Icons' => array('ambulance','h-square','heart','heart-o','heartbeat','hospital-o','medkit','plus-square','stethoscope','user-md','wheelchair'));

        $iconString = '';
        foreach ($iconArray as $iconHeadline => $iconSet) {
            $iconString .= '<div class="faHeadline"><h2>'.$iconHeadline.'</h2></div>';
            foreach($iconSet as $icon) {
                $iconString .= '<div class="faIcon"><i class="fa fa-'.$icon.' fa-2x" onclick="setIconToPreview(\''.$this->strId.'\', \''.$icon.'\')"></i ></div>';
            }
        }

        if ($this->varValue != NULL) {
            $selectIcon = '<i class="fa fa-'.$this->varValue.' fa-4x"></i>';
        } else {
            $selectIcon = 'select icon';
        }

        return '
            <input id="ctrl_'.$this->strId.'" class="tl_text" type="hidden" value="'.$this->varValue.'" name="'.$this->strId.'">
            <a id="'.$this->strId.'_sel" class="faContent" href="#animatedModal">'.$selectIcon.'</a>
            <div id="animatedModal">
                <div id="closebt-container" class="close-animatedModal">
                    <img class="closebt" src="system/modules/mwk-helper-iconpicker/assets/img/closebt.svg">
                </div>
                <div class="modal-content">
                    <div class="modal-content-inside">
                        <div style="float:left;"><input type="text" id="'.$this->strId.'_search" class="tl_text"></div>
                        '.$iconString.'

                    </div>
                </div>
            </div>

            <script>
                jQuery( document ).ready(function() {
                    jQuery("#'.$this->strId.'_sel").animatedModal({
                        color:\'#b0e2ff\'
                    });
                    jQuery("#'.$this->strId.'_search").keyup(function() {
                        filterIcons(jQuery("#'.$this->strId.'_search").val());
                    });
                });
            </script>';
    }
}
