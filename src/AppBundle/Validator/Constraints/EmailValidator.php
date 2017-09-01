<?php

/*
 * This file is part of Moonshot Project 2017.
 *
 * @author Omar Makled <omar.makled@aqarmap.com>
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraints\EmailValidator as ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class EmailValidator extends ConstraintValidator
{
    /**
     * List of not allowed punctuation.
     *
     * @var string
     */
    const PUNCTUATION = '/[,\/#!$%\^&\*;:{}=\`~()]/';

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        //
        if (preg_match(self::PUNCTUATION, $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setCode(Email::INVALID_FORMAT_ERROR)
                ->addViolation();
        }

        parent::validate($value, $constraint);
    }
}
