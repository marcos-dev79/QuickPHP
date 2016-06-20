<?php
/**
 * User: root
 * Date: 15/04/16
 * Time: 10:43
 */

namespace Library\Redis;
use Illuminate\Database\Query\Expression as rawExpression;
use Predis\Client;

class RedisPHP
{
    public $client;
    private $status = false;

    function __construct($offline = false) {
        if (!$offline) {
            try {
                $this->client = new Client();
                try {
                    $this->client->ping();
                    $this->status = true;
                } catch (\Exception $e) {
                    $this->status = false;
                }

            } catch (\Exception $e) {
                $this->client = false;
                $this->status = false;
            }
        } else {
            $this->client = false;
            $this->status = false;
        }
    }

    public function is_online() {
        return $this->status;
    }

    public function del($key) {
        if ($this->client->del($key)) {
            return true;
        }
        return false;
    }

    /**
     * Deleta as entradas que começam com KEY
     * @param $key
     * @return bool
     */
    public function delByMatch($key) {
        if ($keys = $this->client->keys($key.'*')) {
            foreach($keys as $k) {
                $this->client->del($k);
            }
            return true;
        }
        return false;
    }

    public function simpleSet($name, $value) {

        if (is_array($value)) {
            $value = json_encode($value);
        }

        if ($this->client->set($name, $value)) {
            return true;
        }
        return false;
    }

    public function simpleGet($name, $returnType = 'array') {
        if ($value = $this->client->get($name)) {
            if (is_object(json_decode($value)) || is_array(json_decode($value))) {
                if ($returnType == 'array') {
                    return (array) json_decode($value, true);
                }
                return json_decode($value);
            }
            return $value;
        }
        return false;
    }

    public function compare($redisName, $scriptVal) {
        if ($redisVal = $this->simpleGet($redisName)) {
            if ($redisVal == $scriptVal) {
                return true;
            }
        }
        return false;
    }
}