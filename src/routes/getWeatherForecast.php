<?php

$app->post('/api/YahooWeatherAPI/getWeatherForecast', function ($request, $response, $args) {
    $settings =  $this->settings;
    
    $data = $request->getBody();

    if($data=='') {
        $post_data = $request->getParsedBody();
    } else {
        $toJson = $this->toJson;
        $data = $toJson->normalizeJson($data);        
        $post_data = json_decode($data, true);
    }
    
    if(json_last_error() != 0) {
        $error[] = json_last_error_msg() . '. Incorrect input JSON. Please, check fields with JSON input.';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
        $result['contextWrites']['to']['status_msg'] = implode(',', $error);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    $error = [];
    if(empty($post_data['args']['woeid']) && empty($post_data['args']['location'])) {
        $error[] = 'Indicate one of these parameters: woeid or location';
    }
    if(!empty($post_data['args']['woeid']) && !empty($post_data['args']['location'])) {
        $error[] = 'Indicate one of these parameters: woeid or location';
    }
    
    if(!empty($error)) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = "REQUIRED_FIELDS";
        $result['contextWrites']['to']['status_msg'] = "Please, check and fill in required fields.";
        $result['contextWrites']['to']['fields'] = $error;
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    
    if(!empty($post_data['args']['yql'])) {
        $yql = str_replace('\"', '"', $post_data['args']['yql']);
    } else {
        if(!empty($post_data['args']['woeid']) && empty($post_data['args']['location'])) {
            if(!empty($post_data['args']['filter'])) {
                $yql = 'select '.$post_data['args']['filter'].' from weather.forecast where woeid='.$post_data['args']['woeid'];
            } else {
                $yql = 'select * from weather.forecast where woeid='.$post_data['args']['woeid'];
            }
        } elseif(empty($post_data['args']['woeid']) && !empty($post_data['args']['location'])) {
            if(!empty($post_data['args']['filter'])) {
                $filter = is_array($post_data['args']['filter']) ? implode(',', $post_data['args']['filter']) : $post_data['args']['filter'];
                $yql = 'select '.$filter.' from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$post_data['args']['location'].'")';
            } else {
                $yql = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$post_data['args']['location'].'")';
            }
        }
    }
    
    $query_str = 'https://query.yahooapis.com/v1/public/yql?q='.$yql.'&format=json';
    
    $client = $this->httpClient;
    
    try {

        $resp = $client->post( $query_str );
        $responseBody = $resp->getBody()->getContents();
  
        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to'] = "empty list";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }
    
    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
