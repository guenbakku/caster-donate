<?php
namespace App\Form\Me\Contract;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class TermAgreeForm extends Form
{
    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('agree', [
                'type' => 'boolean'
            ]);
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->add('agree', [
                'agreed' => [
                    'rule' => function ($value, $context) {
                        return (bool)$value === true;
                    },
                    'message' => __('Bạn cần phải đồng ý các điều khoản nếu muốn tiếp tục.'),
                ]
            ]);

        return $validator;
    }

    protected function _execute(array $data)
    {
        return true;
    }
}
