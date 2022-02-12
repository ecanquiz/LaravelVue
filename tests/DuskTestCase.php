<?php


namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        if (! static::runningInSail()) {
     //       static::startChromeDriver();
        }
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments(collect([
            '--window-size=1920,1080',
        ])->unless($this->hasHeadlessDisabled(), function ($items) {
            return $items->merge([
                '--disable-gpu',
                '--headless',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://selenium-hub:4444/wd/hub',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }

    /**
     * Determine whether the Dusk command has disabled headless mode.
     *
     * @return bool
     */
    protected function hasHeadlessDisabled()
    {
        return isset($_SERVER['DUSK_HEADLESS_DISABLED']) ||
               isset($_ENV['DUSK_HEADLESS_DISABLED']);
    }
}








// namespace Tests;

// use Derekmd\Dusk\Concerns\TogglesHeadlessMode;
// use Derekmd\Dusk\Firefox\SupportsFirefox;
// use Facebook\WebDriver\Firefox\FirefoxDriver;
// use Facebook\WebDriver\Remote\DesiredCapabilities;
// use Facebook\WebDriver\Remote\RemoteWebDriver;
// use Laravel\Dusk\TestCase as BaseTestCase;

// abstract class DuskTestCase extends BaseTestCase
// {
//     use CreatesApplication, SupportsFirefox, TogglesHeadlessMode;

//     /**
//      * Prepare for Dusk test execution.
//      *
//      * @beforeClass
//      * @return void
//      */
//     public static function prepare()
//     {
//         // if (static::runningFirefoxInSail()) {
//         //     return;
//         // }

//         // static::startFirefoxDriver();
//     }

//     /**
//      * Create the RemoteWebDriver instance.
//      *
//      * @return \Facebook\WebDriver\Remote\RemoteWebDriver
//      */
//     protected function driver()
//     {
//         $options = [
//             'args' => $this->filterHeadlessArguments([
//                 '--headless',
//                 '--window-size=1920,1080',
//             ]),
//         ];

//         $capabilities = DesiredCapabilities::firefox()
//             ->setCapability('moz:firefoxOptions', $options);

//         // $capabilities->getCapability(FirefoxDriver::PROFILE)
//         //     ->setPreference('devtools.console.stdout.content', true);

//         return RemoteWebDriver::create(
//             $_ENV['DUSK_DRIVER_URL'] ?? 'http://selenium-hub:4444/wd/hub',
//             $capabilities
//         );

//         // return RemoteWebDriver::create(
//         //     'http://selenium-hub:4444/wd/hub', DesiredCapabilities::firefox()
//         // );

//         // return RemoteWebDriver::create(
//         //     'http://172.31.0.3:4444/wd/hub', DesiredCapabilities::chrome()->setCapability(
//         //     ChromeOptions::CAPABILITY, $options
//         // ));
        
        
//         // return RemoteWebDriver::create(
//         //     'http://selenium-hub:4444/wd/hub', DesiredCapabilities::firefox()
//         // );



//     }

  
// }
