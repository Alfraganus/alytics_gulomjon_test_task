<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "url_checker".
 *
 * @property int $id
 * @property string|null $url
 * @property int|null $frequency_interval
 * @property int|null $check_repetition_if_error
 * @property string|null $date
 * @property string|null $http_code
 * @property string |null $last_checked_at
 * @property int |null $is_available
 * @property int |null $has_error
 * @property int |null $attempt
 */
class UrlChecker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_checker';
    }
    CONST ERROR_CHECK_FREQUENCY = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frequency_interval', 'check_repetition_if_error','url'], 'required'],
            [['frequency_interval', 'check_repetition_if_error','is_available','has_error','attempt'], 'integer'],
            [['date','last_checked_at','http_code'], 'safe'],
            [['url'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'frequency_interval' => 'Frequency Interval (in minutes)',
            'check_repetition_if_error' => 'Retry interval in case if error (in minutes)',
            'date' => 'Date',
            'http_code' => 'HTTP code',
        ];
    }

    public function setHTTPResponseStatusCode($url)
    {
        $status = null;

        $headers = @get_headers($url, 1);
        if (is_array($headers)) {
            $status = substr($headers[0], 9);
        }

        $this->http_code = $status;
    }

    public function checkDomain($interval, $url,$last_checked_at)
    {

        if(!Carbon::parse($last_checked_at)
            ->addMinutes($interval)
            ->greaterThan(date('Y-m-d h:i:s')))
        {
            if($this->checkUrl($url)) {
                return true;
            }
        }
        return false;
    }

    public function setDomainAvailability($url)
    {
        $this->is_available = false;

        if($this->checkUrl($url)) {
            return $this->is_available = true;
        }

    }

    public function setError($error)
    {
        $this->has_error = false;
        if($error) {
            $this->has_error = true;
        }
    }

    public function setAttempt($attempt)
    {
        $attempt < 1 ?
            $this->attempt   =  1 :
            $this->attempt   =  $attempt+1;
    }

    public function checkUrl($url)
    {
        $url = parse_url($url)['host'];

        if(checkdnsrr($url)) {
         return true;
        }
    }



    public static function getInvervalTime()
    {
        return [
            1 => 'every 1 minute',
            2 => 'every 5 minutes',
            3 => 'every 10 minutes',
        ];
    }



}
