# Feedme Helper plugin for Craft CMS

CSV Datatype for Feedme. 

You can also use this plugin as a scaffold to easily add your own custom Datatypes to Feedme.



## Installation

To install Feedme Helper, follow these steps:

1. Download & unzip the file and place the `feedmecsv` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/surprisehighway/feedmehelper.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require surprisehighway/feedmehelper`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `feedmehelper` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

## Requirements

[Feedme Pro](https://sgroup.com.au/plugins/feedme/getting-started/pricing) is required to use custom DataTypes.

Feedme Helper works on Craft 2.4.x and Craft 2.5.x.

## Importing CSV Data

**Important: Your CSV file must have a header row.** This is used by FeedMe to identify columns for field mapping and save the feed settings.

```
header1,"Header Two",header3
"Row One","Data Column two",123456
"Row two","Row two data Column two",654321
```

1. Creat a new Feed, setting your [Feed URL](https://sgroup.com.au/plugins/feedme/feature-tour/creating-your-feed#feed-url) and selecting `CSV Feed` from [Feed Type](https://sgroup.com.au/plugins/feedme/feature-tour/creating-your-feed#feed-type) dropdown.
2. Carry on with normal FeedMe import settings and field mapping.

## Bonus How-to: Creating a Custom Data Source

1. Add a new datatype Class under `integrations/datatypes`
2. In the plugin file `init()` function, import the class.
3. In the plugin file add your datatype to the Feedme `registerFeedMeDataTypes()` hook.

```
public function init()
{
    Craft::import('plugins.feedmehelper.integrations.feedme.datatypes.CsvFeedMeDataType');
    Craft::import('plugins.feedmehelper.integrations.feedme.datatypes.MyCustomFeedMeDataType');
}

public function registerFeedMeDataTypes()
{
    return array(
        new CsvFeedMeDataType(),
        new MyCustomFeedMeDataType(),
    );
}
```

Whatever your external data source is in the end your datatype class needs to parse the data into an associative array that is returned to Feedme. The array keys are used to save the feed settings in the database, (which is why CSV data needs a header row).

Currently the [Feedme docs for adding Datatypes](https://sgroup.com.au/plugins/feedme/developers/data-types) are incomplete, so hopefully this might be helpful to someone else.

```
<?php
namespace Craft;

class MyCustomFeedMeDataType extends BaseFeedMeDataType
{
    public function getFeed($url, $primaryElement, $settings)
    {   
        // Do stuff here... see the CSV or Default FeedMe datatypes for examples...

        return $associative_array;
    }
}
```

## Credit

All credit goes to Engram Design for the fantasic [FeedMe](https://github.com/engram-design/FeedMe) plugin and default `JSON` datatype which this `CSV` adapter is derived from.

---
Brought to you by Mike Kroll and [Surprise Highway](http://surprisehighway.com)
