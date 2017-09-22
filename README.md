[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/YahooWeatherAPI/functions?utm_source=RapidAPIGitHub_YahooWeatherFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Yahoo! Weather API package
===================

Get up-to-date weather forecast for any location.

## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

----------


**getWeatherForecast**
-------

This endpoint allows to receive weather information. 

| Field      | Type      | Description   |
| -------    | ----      | ---           |
| `woeid`    | String    |  Optional: The location for the weather forecast as a WOEID, example is 2487889 (San Diego, CA). Required if location not provided. |
| `location` | String    |  Optional: The location for the weather forecast as Text, example \"chicago, il\". Required if woeid not provided.   |
| `filter`   | List    |  Optional: The array of data to be received. For example: wind, item.condition.text, astronomy.sunset. |
| `yql`      | String    |  Optional: Your custom yql expression. Example: \"select item.condition from weather.forecast where woeid = 2487889\". NOTE: If provided yql parameter, other parameters will be ignored. |

### filter field format: 

```json
wind,item.condition
```

### yql field format: 

```json
select item.condition from weather.forecast where woeid = 2487889
```
To get all possible values,  execute request with parameter `woeid` or `location`. Possible values to be filtered be shown in query.results.channel.
For example:
1) location.city - will return information about just about city
2) astronomy - will return only astronomy data
2) wind,description - will return information only for wind section and description 

**Response example**
```json
{  
    "callback":"success",
    "contextWrites":{  
        "to":{  
            "query":{  
                "count":1,
                "created":"2016-11-17T09:57:24Z",
                "lang":"en-US",
                "results":{  
                    "channel":{  
                        "units":{  
                            "distance":"mi",
                            "pressure":"in",
                            "speed":"mph",
                            "temperature":"F"
                        },
                        "title":"Yahoo! Weather - New York, NY, US",
                        "link":"http://us.rd.yahoo.com/dailynews/rss/weather/Country__Country/*https://weather.yahoo.com/country/state/city-2459115/",
                        "description":"Yahoo! Weather for New York, NY, US",
                        "language":"en-us",
                        "lastBuildDate":"Thu, 17 Nov 2016 04:57 AM EST",
                        "ttl":"60",
                        "location":{  
                            "city":"New York",
                            "country":"United States",
                            "region":" NY"
                        },
                        "wind":{  
                            "chill":"46",
                            "direction":"325",
                            "speed":"14"
                        },
                        "atmosphere":{  
                            "humidity":"68",
                            "pressure":"1013.0",
                            "rising":"0",
                            "visibility":"16.1"
                        },
                        "astronomy":{  
                            "sunrise":"6:46 am",
                            "sunset":"4:36 pm"
                        },
                        "image":{  
                            "title":"Yahoo! Weather",
                            "width":"142",
                            "height":"18",
                            "link":"http://weather.yahoo.com",
                            "url":"http://l.yimg.com/a/i/brand/purplelogo//uh/us/news-wea.gif"
                        },
                        "item":{  
                            "title":"Conditions for New York, NY, US at 04:00 AM EST",
                            "lat":"40.71455",
                            "long":"-74.007118",
                            "link":"http://us.rd.yahoo.com/dailynews/rss/weather/Country__Country/*https://weather.yahoo.com/country/state/city-2459115/",
                            "pubDate":"Thu, 17 Nov 2016 04:00 AM EST",
                            "condition":{  
                                "code":"31",
                                "date":"Thu, 17 Nov 2016 04:00 AM EST",
                                "temp":"50",
                                "text":"Clear"
                            },
                            "forecast":[  
                                {  
                                    "code":"32",
                                    "date":"17 Nov 2016",
                                    "day":"Thu",
                                    "high":"61",
                                    "low":"48",
                                    "text":"Sunny"
                                },
                                {  
                                    "code":"32",
                                    "date":"18 Nov 2016",
                                    "day":"Fri",
                                    "high":"62",
                                    "low":"46",
                                    "text":"Sunny"
                                },
                                {  
                                    "code":"34",
                                    "date":"19 Nov 2016",
                                    "day":"Sat",
                                    "high":"63",
                                    "low":"47",
                                    "text":"Mostly Sunny"
                                },
                                {  
                                    "code":"23",
                                    "date":"20 Nov 2016",
                                    "day":"Sun",
                                    "high":"52",
                                    "low":"42",
                                    "text":"Breezy"
                                },
                                {  
                                    "code":"23",
                                    "date":"21 Nov 2016",
                                    "day":"Mon",
                                    "high":"44",
                                    "low":"38",
                                    "text":"Breezy"
                                },
                                {  
                                    "code":"23",
                                    "date":"22 Nov 2016",
                                    "day":"Tue",
                                    "high":"47",
                                    "low":"36",
                                    "text":"Breezy"
                                },
                                {  
                                    "code":"30",
                                    "date":"23 Nov 2016",
                                    "day":"Wed",
                                    "high":"49",
                                    "low":"38",
                                    "text":"Partly Cloudy"
                                },
                                {  
                                    "code":"28",
                                    "date":"24 Nov 2016",
                                    "day":"Thu",
                                    "high":"52",
                                    "low":"41",
                                    "text":"Mostly Cloudy"
                                },
                                {  
                                    "code":"30",
                                    "date":"25 Nov 2016",
                                    "day":"Fri",
                                    "high":"48",
                                    "low":"38",
                                    "text":"Partly Cloudy"
                                },
                                {  
                                    "code":"12",
                                    "date":"26 Nov 2016",
                                    "day":"Sat",
                                    "high":"49",
                                    "low":"38",
                                    "text":"Rain"
                                }
                            ],
                            "description":"<![CDATA[<img src=\"http://l.yimg.com/a/i/us/we/52/31.gif\"/>\n<BR />\n<b>Current Conditions:</b>\n<BR />Clear\n<BR />\n<BR />\n<b>Forecast:</b>\n<BR /> Thu - Sunny. High: 61Low: 48\n<BR /> Fri - Sunny. High: 62Low: 46\n<BR /> Sat - Mostly Sunny. High: 63Low: 47\n<BR /> Sun - Breezy. High: 52Low: 42\n<BR /> Mon - Breezy. High: 44Low: 38\n<BR />\n<BR />\n<a href=\"http://us.rd.yahoo.com/dailynews/rss/weather/Country__Country/*https://weather.yahoo.com/country/state/city-2459115/\">Full Forecast at Yahoo! Weather</a>\n<BR />\n<BR />\n(provided by <a href=\"http://www.weather.com\" >The Weather Channel</a>)\n<BR />\n]]>",
                            "guid":{  
                                "isPermaLink":"false"
                            }
                        }
                    }
                }
            }
        }
    }
}
```
