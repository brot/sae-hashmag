<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Core\Helpers\Validator;

final class ValidatorTest extends TestCase
{
    public function providedTestData()
    {
        return array(
          array('Max', 'Firstname', true, 3, 100, false),   // test min boundary
          array('Sepp', 'Firstname', true, 3, 4, false),    // test max boundary
          array('Karin', 'Firstname', true, 3, 100, false),
          array('Mo', 'Firstname', true, 3, 100,
                array('Firstname has not enough characters. The minimum is 3 characters.')),
          array('Moses', 'Firstname', true, 3, 4,
                array('Firstname has to many characters. The maximum is 4 characters.')),
          array('wrong-email', 'Email', true, 5, 100, array("Email isn't valid!")),
          array('', 'Password', true, 10, 255, array("Password can't be left blank!")),
        );
    }

    /**
     * @dataProvider providedTestData
     */
    public function testValidate($value, $name, $required, $min, $max, $expectedErrorResult): void
    {
        $validator = new Validator();
        $validator->validate($value, $name, $required, 'text', $min, $max);
        $this->assertEquals($expectedErrorResult, $validator->getErrors());
    }
}