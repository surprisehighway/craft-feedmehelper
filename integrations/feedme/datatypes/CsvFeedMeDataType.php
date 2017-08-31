<?php
namespace Craft;

use League\Csv\Reader;

class CsvFeedMeDataType extends BaseFeedMeDataType
{

    // Public Methods
    // =========================================================================

    public function getFeed($url, $primaryElement, $settings)
    {   
        // Check for when calling via templates (there's no feed model)
        $name = ($settings) ? $settings->name . ': ' : '';

        if (false === ($raw_content = craft()->feedMe_data->getRawData($url))) {
            FeedMePlugin::log($name . 'Unable to reach ' . $url . '. Check this is the correct URL.', LogLevel::Error, true);

            return false;
        }

        // Parse the CSV string - using the PHPLeague CSV package
        try {
            $reader = Reader::createFromString($raw_content);

            $csv_array = array();

            // Create associative array with Row 1 header as keys
            $offset = 0;
            foreach($reader->fetchAssoc($offset) as $row) {
                $csv_array[] = $row;
            }
        } catch (Exception $e) {
            FeedMePlugin::log($name . 'Invalid CSV - ' . $e->getMessage(), LogLevel::Error, true);

            return false;
        }

        // Look for and return only the items for primary element
        if ($primaryElement && is_array($csv_array)) {
            $csv_array = craft()->feedMe_data->findPrimaryElement($primaryElement, $csv_array);
        }

        if (!is_array($csv_array)) {
            FeedMePlugin::log($name . 'Invalid CSV - could not convert to array.', LogLevel::Error, true);
            
            return false;
        }

        return $csv_array;
    }
}
