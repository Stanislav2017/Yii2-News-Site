<?php

use yii\db\Migration;

/**
 * Class m181001_081454_create_post
 */
class m181001_081454_create_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
           'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'user_id' => $this->integer(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('post');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181001_081454_create_post cannot be reverted.\n";

        return false;
    }
    */
}
