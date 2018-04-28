<?php


namespace AppBundle\Validator;


use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class ArrayNotEmpty extends Constraint
{

    /**
     * @var string
     */
    public $message = 'none option selected';

    /**
     * @return string
     * @author Robert Glazer
     */
    public function validatedBy()
    {
        return 'AppBundle\Validator\Constraints\ArrayNotEmptyValidator';
    }

}