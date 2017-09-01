<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Validator\Constraints\ContainsAlphanumeric;
use Symfony\Component\Validator\Context\ExecutionContext;
use AppBundle\Validator\Constraints\ContainsAlphanumericValidator;

class SomeTest extends WebTestCase
{
    public function testBar()
    {
        $emptyVatin = '@@@';
        $validator  = new ContainsAlphanumericValidator();
        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        $context->expects($this->once())
            ->method('addViolation')
            ->with($this->equalTo('[message]'), $this->equalTo(array('%string%', '')));

        $validator->initialize($context);
        $constraint = new ContainsAlphanumeric([]);


        // dump($validator); die();
        $validator->validate($emptyVatin, $constraint);

        dump($validator->count()); die();
        // Assert
        $this->assertGreaterThan(0, $violations->count());
    }

    public function testFoo()
    {
        $input_line = 'hi ~ , \ / safd * ; : { } ` ~ { } / \/';

        preg_match("/[\\,\/#!$%\^&\*;:{}=\`~()]/", $input_line, $output_array);

        $this->assertCount(1, $output_array);
    }

    public function testFoo2()
    {
        $input_line = 'hiallfound';

        preg_match("/[\\,\/#!$%\^&\*;:{}=\`~()]/", $input_line, $output_array);

        $this->assertCount(0, $output_array);
    }
}
