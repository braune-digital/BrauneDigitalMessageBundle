<?php
/**
 * @author Torge Rothe <tr@braune-digital.com>
 * @company Braune Digital GmbH
 * @date 14.08.19
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class MessageFormType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder->add('subject');
        $builder->add('content');
        $builder->add('recipients');
    }

}
