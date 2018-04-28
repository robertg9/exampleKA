<?php


namespace AppBundle\Validator\Constraints;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ArrayNotEmptyValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        /**
         * @var ArrayCollection|array $value
         */
        $arrayIsEmpty =
            (is_array($value) && empty($value)) ||
            ($value instanceof ArrayCollection && empty($value->toArray()))
        ;

        if ($arrayIsEmpty) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

}