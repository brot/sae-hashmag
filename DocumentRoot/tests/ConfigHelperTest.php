<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Core\Helpers\Config;

final class ConfigHelperTest extends TestCase
{
    /**
     * Test that the configured database host is "mariadb"
     */
    public function testReturnsDefaultValue(): void
    {
        $this->assertEquals(
            'mariadb',                          // expected
            Config::get('database.host'),       // actual
        );
    }

    /**
     * Test that the returned config value is empty 
     * if the config string is too short (<3)
     */
    public function testConfigValueTooShort(): void
    {
        $this->assertEquals(
            '',
            Config::get('ab'),
        );
    }

    /**
     * Test that the returned config value is the default value, 
     * because we pass in a non existing config value
     */
    public function testReturnDefaultConfigValue(): void
    {
        $default_value = 'default';
        $this->assertEquals(
            $default_value,
            Config::get('database.nothing', $default_value),
        );
    }

    /**
     * Use a wrong configString Format for this tests
     * Code requires a configString with '.' and a minimum lengths of 3
     */
    public function testConfigValueWithWrongFormat(): void
    {
        $this->markTestIncomplete(
            'This test fails, because the configString parsing is incomplete'
        );

        $default_value = 'default';
        $this->assertEquals(
            $default_value,
            Config::get('abc', $default_value),
        );
    }

    /**
     * Use a non existing config php module name
     */
    public function testConfigValueWithWrongFilename(): void
    {
        $this->markTestIncomplete(
            'This test fails, because the filename we require should be checked!'
        );

        $default_value = 'default';
        $this->assertEquals(
            $default_value,
            Config::get('appx.baseUrl', $default_value),
        );
    }
}