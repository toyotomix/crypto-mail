<?php

namespace App\Commons\Api;

use GuzzleHttp\Client;

class CoinGecko {
    
    // base url
    private static $base_uri = 'https://api.coingecko.com/api/v3/';

    /**
     * 通貨リスト取得
     * 
     * @return Array
     */
    public static function fetchCoinsList()
    {
        // path
        $path = 'coins/list';
        try {
            // GuzzleHttp Client作成
            $client = new Client(['base_uri' => self::$base_uri]);
            
            // リクエスト
            $response = $client->request('GET', $path);
            
            // JSONデコード
            return json_decode($response->getBody(), true);
            
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
    
    /**
     * コイン詳細取得
     * 
     * @param string geckoId
     * @return Obj
     */
    public static function fetchCoinInfo($id)
    {
        // path
        $path = 'coins/' . $id;
        try {
            // GuzzleHttp Client作成
            $client = new Client(['base_uri' => self::$base_uri]);
            
            // リクエスト
            $response = $client->request('GET', $path, [
                'query' => [
                    'tickers' => 'false',
                    'market_data' => 'false',
                    'community_data' => 'false',
                    'developer_data' => 'false',
                    'sparkline' => 'false',
                ]
            ]);
            
            // JSONデコード
            return json_decode($response->getBody(), true);
            
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
    
    /**
     * マーケット情報取得
     * 
     * @param int $per_page 1ページあたりの表示数
     * @param int $page ページ番号
     * @return Obj
     */
    public static function fetchMarkets($per_page, $page)
    {
        // path
        $path = 'coins/markets';
        try {
            // GuzzleHttp Client作成
            $client = new Client(['base_uri' => self::$base_uri]);
            
            // リクエスト
            $response = $client->request('GET', $path, [
                'query' => [
                    'vs_currency' => 'jpy',
                    'order' => 'market_cap_desc',
                    'per_page' => (string) $per_page,
                    'page' => (string) $page,
                    'sparkline' => 'false',
                ]
            ]);
            
            // JSONデコード
            return json_decode($response->getBody(), true);
            
        } catch (ClientException $e) {
            echo Psr7\str($e->getRequest());
            echo Psr7\str($e->getResponse());
        }
    }
}