Yahoo! Weather API package
===================


Get up-to-date weather information for any location, including 5-day forecast, wind, atmosphere, astronomy conditions, and more.

----------


**getWheatherForecast**
-------

This endpoint allows to receive weather information. 

| Field      | Type      | Description   |
| -------    | ----      | ---           |
| `woeid`    | String    |  Optional: The location for the weather forecast as a WOEID, example is 2487889 (San Diego, CA). Required if location not provided. |
| `location` | String    |  Optional: The location for the weather forecast as Text, example \"chicago, il\". Required if woeid not provided.   |
| `filter`   | String    |  Optional: The comma-separated filter of data to be received. For example: wind, item.condition.text, astronomy.sunset. |
| `yql`      | String    |  Optional: Your custom yql expression. Example: \"select item.condition from weather.forecast where woeid = 2487889\". NOTE: If provided yql parameter, other parameters will be ignored. |

### filter format: 

```json
wind,item.condition
```
To get all possible values,  execute request with parameter `woeid` or `location`. Possible values to be filtered be shown in query.results.channel.
For example:
1) location.city - will return information about just about city
2) astronomy - will return only astronomy data
2) wind,description - will return information only for wind section and description  