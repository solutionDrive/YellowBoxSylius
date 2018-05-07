<?php

declare(strict_types=1);

namespace Tests\solutionDrive\YellowBox\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\solutionDrive\YellowBox\Behat\Page\Shop\WelcomePageInterface;
use Tests\solutionDrive\YellowBox\Behat\Page\Shop\YellowBoxPage;
use Webmozart\Assert\Assert;

final class YellowBoxContext implements Context
{
    /**
     * @var YellowBoxPage
     */
    private $yellowBoxPage;

    /**
     * @param YellowBoxPage $yellowBoxPage
     */
    public function __construct(YellowBoxPage $yellowBoxPage)
    {
        $this->yellowBoxPage = $yellowBoxPage;
    }

    /**
     * @when I am on the yellow-box page
     */
    public function iAmOnTheYellowBoxPage()
    {
        $this->yellowBoxPage->open();
    }

    /**
     * @then I should see the yellow-box overlay
     */
    public function iShouldSeeTheYellowBoxOverlay()
    {
        if (!$this->yellowBoxPage->overlayExists()) {
            throw new \Exception('YellowBox ist nicht auf der Seite');
        }
    }

}
