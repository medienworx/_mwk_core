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
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'medienworx',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(
    array(
        // Core Classes
        'medienworx\MwkCoreHelper'              => 'system/modules/_mwk-core/src/medienworx/class/MwkCoreHelper.php',
        'medienworx\IconPickerSelectField'		=> 'system/modules/_mwk-core/widgets/IconPickerSelectField.php'
    )
);

