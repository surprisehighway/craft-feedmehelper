<?php
/**
 * Feedme CSV plugin for Craft CMS
 *
 * CSV Datatype for Feedme.
 *
 * @author    Mike Kroll
 * @copyright Copyright (c) 2017 Mike Kroll
 * @link      http://surprisehighway.com
 * @package   FeedmeCsv
 * @since     1.0.0
 */

namespace Craft;

require __DIR__ . '/vendor/autoload.php';

class FeedmeHelperPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Feedme Helper');
    }

    public function getDescription()
    {
        return Craft::t('CSV Datatype for Feedme.');
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/surprisehighway/feedmehelper/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/surprisehighway/feedmehelper/master/releases.json';
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Mike Kroll';
    }

    public function getDeveloperUrl()
    {
        return 'http://surprisehighway.com';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function init()
    {
        Craft::import('plugins.feedmehelper.integrations.feedme.datatypes.CsvFeedMeDataType');
    }

    // =========================================================================== //
    // For compatibility with Feed Me plugin (v2.x)
    public function registerFeedMeDataTypes()
    {
        return array(
            new CsvFeedMeDataType(),
        );
    }
}