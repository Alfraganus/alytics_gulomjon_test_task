<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\UrlChecker;
use Carbon\Carbon;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CheckUrlController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */

    private $model;

    public function __construct($id, $module, $config = [])
    {
         $this->model =  UrlChecker::find();
        parent::__construct($id, $module, $config);
    }

    public function actionStartCheck()
    {
        $urls = $this->model->where(['has_error' => false])->each();
        $model = new UrlChecker();
        foreach ($urls as $url) {
            try {
                if ($model->checkDomain(
                    $url->frequency_interval,
                    $url->url,
                    $url->last_checked_at)
                ) {
                    $url->setDomainAvailability($url->url);
                    $url->setError(false);
                }
                $url->save(false);
            } catch (\Exception $e) {
                $url->setError(true);
                $url->setAttempt($url->attempt);

            }
            $url->setHTTPResponseStatusCode($url->url);
            $url->last_checked_at = date('Y-m-d h:i:s');
            $url->save(false);
        }
    }

    public function actionCheckErrorConnections()
    {
        $urls = $this->model->where(['has_error' => true])->each();
        $model = new UrlChecker();

        foreach ($urls as $url) {

            /*checking if check limit has been reached*/
            if ($url->attempt < $url->check_repetition_if_error) {
                try {
                    $url->getHTTPResponseStatusCode($url->url);
                    if ($model->checkDomain(
                        UrlChecker::ERROR_CHECK_FREQUENCY,
                            $url->url,
                            $url->last_checked_at))
                     {
                        $url->setDomainAvailability($url->url);
                        $url->setError(false);
                    }
                } catch (\Exception $e) {
                    $url->last_checked_at = date('Y-m-d h:i:s');
                    $url->setError(true);
                    $url->setAttempt($url->attempt);

                }
                $url->last_checked_at = date('Y-m-d h:i:s');
                $url->save(false);
            }
        }
    }








}
