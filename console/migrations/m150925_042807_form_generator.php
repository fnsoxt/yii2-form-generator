<?php

use yii\db\Schema;
use yii\db\Migration;

class m150925_042807_form_generator extends Migration
{
    public function up()
    {
        $sql = <<<'EOF'
CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `desc` text COMMENT '描述',
  `template_name` varchar(255) DEFAULT NULL COMMENT '模板名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `options` text COMMENT '参数',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL COMMENT '表单ID',
  `name` text NOT NULL COMMENT '名称',
  `desc` text COMMENT '描述',
  `type` text NOT NULL COMMENT '类型',
  `default` text COMMENT '默认值',
  `options` text COMMENT '参数',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '顺序',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT '是否必须',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  CONSTRAINT `field_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL COMMENT '表单ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `desc` text COMMENT '描述',
  `ip` text NOT NULL COMMENT 'IP地址',
  `create_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `item_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL COMMENT '选项ID',
  `field_id` int(11) NOT NULL COMMENT '域ID',
  `value` text COMMENT '值',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `field_id` (`field_id`),
  CONSTRAINT `item_field_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `item_field_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`)
) ENGINE=InnoDB;
EOF;
        $this->execute($sql);
    }

    public function down()
    {
        echo "m150925_042807_form_generator remove.\n";
        $this->dropTable('{{%item_field}}');
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%field}}');
        $this->dropTable('{{%form}}');
    }
}
