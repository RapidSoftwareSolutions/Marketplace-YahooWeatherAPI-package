<?php

namespace Test\Functional;

class YahooWeatherAPITest extends BaseTestCase {
    
    public function testGetWheatherForecast() {
        
        $var = '{
                    "args": {
                            "location": "kyiv",
                            "filter": "wind"
                    }
                }';
        $post_data = json_decode($var, true);

        $response = $this->runApp('POST', '/api/YahooWeatherAPI/getWheatherForecast', $post_data);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getBody());
        $this->assertEquals('success', json_decode($response->getBody())->callback);
    }
    
}
