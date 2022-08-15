<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%url_checker}}`.
 */
class m220812_115431_create_url_checker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%url_checker}}', [
            'id' => $this->primaryKey(),
            'url'=>$this->string(400),
            'is_available'=>$this->integer()->null(),
            'frequency_interval'=>$this->integer(),
            'check_repetition_if_error'=>$this->integer(),
            'date'=>$this->timestamp()->null(),
            'http_code'=>$this->string(50)->null(),
            'last_checked_at'=>$this->dateTime()->null(),
            'has_error'=>$this->integer()->null(),
            'attempt'=>$this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%url_checker}}');
    }
}
