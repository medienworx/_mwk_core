<?php
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

/**
 * Run in a custom namespace, so the class can be replaced
 */

namespace medienworx;

/**
 * Class ModuleMwkVMHelper
 * @package medienworx
 */
class MwkCoreHelper extends \Module
{

    /**
     *
     */
    protected function compile()
    {

    }

    /**
     * @param $encloser
     * @param $string
     * @param $dataArray
     * @return mixed|string
     */
    public static function showFieldIfNotEmpty($encloser, $string, $dataArray)
    {
        if ($dataArray['value'] != '' && $dataArray['display'] == 1) {
            $string = str_replace('?', $dataArray['value'], $string);
            if ($encloser != '') {
                $string = '<'.$encloser.'>'.$string.'</'.$encloser.'>';
            }
        } else {
            $string = '';
        }
        return $string;
    }

    /**
     * Helper function to load and filter fields like definded in the module
     * config. load file data if there is an file
     *
     * @param $configArray
     * @return array
     */
    public static function handleFields($configArray)
    {
        // return Array
        $returnArray = array();

        // load language file
        \System::loadLanguageFile($configArray['dbTable']);

        $a = 0;
        //clear the not available fields
        foreach ($configArray['dataSets'] as $dataSetRow) {

            foreach ($dataSetRow->row() as $aKey => $aData) {
                $returnArray[$a][$aKey] = array(
                    'value' => $aData,
                    'label' => $GLOBALS['TL_LANG'][$configArray['dbTable']][$aKey][0],
                    'display' => 1
                );
                // check if dataType is file

                if (($configArray['dcaFields'][$aKey]['inputType'] == 'text' && $configArray['dcaFields'][$aKey]['wizard'][0][1] == 'filePicker') ||
                    $configArray['dcaFields'][$aKey]['inputType'] == 'fileTree') {

                    if ($aData != '') {
                        $fileData = \FilesModel::findMultipleByPaths(array($aData));

                        if (in_array($fileData->extension, array('jpg', 'gif', 'png', 'ico', 'bmp'))) {
                            $imageSize = getimagesize($fileData->path);
                        }

                        $returnArray[$a][$aKey]['value'] = array(
                            'id' => $fileData->id,
                            'tstamp' => $fileData->tstamp,
                            'type' => $fileData->type,
                            'path' => $fileData->path,
                            'extension' => $fileData->extension,
                            'name' => $fileData->name,
                            'importantPartX' => $fileData->importantPartX,
                            'importantPartY' => $fileData->importantPartY,
                            'importantPartWidth' => $fileData->importantPartWidth,
                            'importantPartHeight' => $fileData->importantPartHeight,
                            'meta' => $fileData->meta,
                            'imageSize' => $imageSize
                        );

                    }
                }

                if (count($configArray['availableFields']) > 0 && $configArray['availableFields'] != false) {
                    if (!in_array($aKey, $configArray['availableFields'])) {
                        $returnArray[$a][$aKey]['display'] = 0;
                    }
                }
            }
            $a++;
        }
        return $returnArray;
    }

    /**
     * include dca files for field types
     *
     * @param $path
     */
    public static function includeDcaFile($path)
    {

        $globalKey = substr($path, strrpos($path, '/')+1, strlen($path)-strrpos($path, '.'));

        if(!array_key_exists($globalKey, $GLOBALS['TL_DCA'])) {
            if (file_exists($path)) {
                require_once($path);
            }
        }
    }

    /**
     * insert only script to globals if not loaded
     * @param $filePath
     */
    public static function insertScriptToGlobals($filePath)
    {
        $fileType = strtolower(substr($filePath, strrpos($filePath, '.') + 1));
        $fileName = strtolower(substr($filePath, strrpos($filePath, '/') + 1));
        $stringFound = false;

        // check if the path string has the / and the TL_PATH if set
        if (substr($filePath, 0, 1) != "/") {
            $filePath = '/'.$filePath;
        }
        if (TL_PATH != '') {
            if (substr($filePath, 0, strlen(TL_PATH)) != TL_PATH) {
                $filePath = TL_PATH.$filePath;
            }
        }

        switch ($fileType) {
            case 'css':
                if (array_key_exists('TL_CSS', $GLOBALS)) {
                    foreach ($GLOBALS['TL_CSS'] as $cssString) {
                        if (strpos($cssString, $fileName) == true) {
                            $stringFound = true;
                        }
                    }
                }
                if ($stringFound == false) {
                    $GLOBALS['TL_CSS'][] = $filePath;
                }
                break;
            case 'js':
                if (array_key_exists('TL_JAVASCRIPT', $GLOBALS)) {
                    foreach ($GLOBALS['TL_JAVASCRIPT'] as $jsString) {
                        if (strpos($jsString, $fileName) == true) {
                            $stringFound = true;
                        }
                    }
                }
                if ($stringFound == false) {
                    $GLOBALS['TL_JAVASCRIPT'][] = $filePath;
                }
                break;
        }
    }

    /**
     * Return the link picker wizard
     *
     * @param \DataContainer
     * @return string
     */
    public static function pagePicker( DataContainer $dc ) {
        return ' <a href="contao/page.php?do=' . Input::get( 'do' ) . '&amp;table=' . $dc->table . '&amp;field=' . $dc->field . '&amp;value=' . str_replace( array( '{{link_url::', '}}' ), '', $dc->value ) . '" title="' . specialchars( $GLOBALS['TL_LANG']['MSC']['pagepicker'] ) . '" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':765,\'title\':\'' . specialchars( str_replace( "'", "\\'", $GLOBALS['TL_LANG']['MOD']['page'][0] ) ) . '\',\'url\':this.href,\'id\':\'' . $dc->field . '\',\'tag\':\'ctrl_'. $dc->field . ( ( Input::get( 'act' ) == 'editAll' ) ? '_' . $dc->id : '' ) . '\',\'self\':this});return false">' . Image::getHtml( 'pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top;cursor:pointer"' ) . '</a>';
    }

    /**
     * Return the file picker wizard
     * @param \DataContainer
     * @return string
     */
    public static function filePicker(DataContainer $dc)
    {
        return ' <a href="contao/file.php?do='.Input::get('do').'&amp;table='.$dc->table.'&amp;field='.$dc->field.'&amp;value='.$dc->value.'" title="'.specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['MSC']['filepicker'])).'" onclick="Backend.getScrollOffset();Backend.openModalSelector({\'width\':768,\'title\':\''.specialchars($GLOBALS['TL_LANG']['MOD']['files'][0]).'\',\'url\':this.href,\'id\':\''.$dc->field.'\',\'tag\':\'ctrl_'.$dc->field . ((Input::get('act') == 'editAll') ? '_' . $dc->id : '').'\',\'self\':this});return false">' . Image::getHtml('pickfile.gif', $GLOBALS['TL_LANG']['MSC']['filepicker'], 'style="vertical-align:top;cursor:pointer"') . '</a>';
    }

    /**
     * search for an certain content element and insert an specific after them
     * @param $dc
     * @param $contentElementTypeFind
     * @param $contentElementTypeInsert
     */
    public static function checkForEndContentElement($dc, $contentElementTypeFind, $contentElementTypeInsert)
    {
        $activeRecord = $dc->activeRecord;

        // get content elements from page by pid
        $conentObj = \Contao\ContentModel::findPublishedByPidAndTable($activeRecord->pid, 'tl_article', array('order' => 'sorting ASC'));

        $endFound = null;
        // check if there is an end after start element
        foreach($conentObj as $conentElement) {
            if($conentElement->type == $contentElementTypeInsert){
                $endFound = true;
            } elseif($conentElement->type == $contentElementTypeFind){
                if($endFound === false) {
                    // insert bootstrap end
                    $objContent = new \Contao\ContentModel();
                    $objContent->pid = $activeRecord->pid;
                    $objContent->sorting = $activeRecord->sorting-1;
                    $objContent->type = $contentElementTypeInsert;
                    $objContent->tstamp = time();
                    $objContent->save();
                } elseif ($endFound === null) {
                    $endFound = false;
                } else {
                    $endFound = false;
                }
            }
        }
        // insert end element
        if($endFound === false) {
            $objContent = new \Contao\ContentModel();
            $objContent->pid = $activeRecord->pid;
            $objContent->sorting = $activeRecord->sorting+1;
            $objContent->type = $contentElementTypeInsert;
            $objContent->tstamp = time();
            $objContent->save();
        }
    }

    /**
     * search for an element and return the config fields defined
     * @param $dc
     * @param $contentElementType
     * @param $configFields
     * @return array
     */
    public static function loadConfigFromCeElement($dc, $contentElementType, $configFields)
    {
        $activeRecord = $dc->activeRecord;

        // get content elements from page by pid
        $conentObj = \ContentModel::findPublishedByPidAndTable($activeRecord->pid, 'tl_article', array('order' => 'sorting ASC'));

        $returnArray = array();
        // find the element with the configs
        foreach ($conentObj as $conentElement) {
            if ($conentElement->id == $activeRecord) {
                break;
            }
            if ($conentElement->type == $contentElementType) {
                foreach ($configFields as $configField) {
                    $returnArray[$configField] = $conentElement->$configField;
                }
            }
        }
        return $returnArray;
    }
}