<?php

declare(strict_types=1);

namespace Tests\solutionDrive\YellowBox\Behat\Context\Ui\Shop;

use Behat\Behat\Tester\Exception\PendingException;
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

    /**
     * @When i click on the yellow-box symbol
     */
    public function iClickOnTheYellowBoxSymbol()
    {
        $this->yellowBoxPage->clickOverlaySymbol();
    }

    /**
     * @Then i should see the expanded yellow-box overlay
     */
    public function iShouldSeeTheExpandedYellowBoxOverlay()
    {
        if (!$this->yellowBoxPage->isOverlayExpanded()) {
           throw new \Exception('YellowBox overlay is not expanded');
        }
    }

    /**
     * @Then i click on the close button
     */
    public function iClickOnTheCloseButton()
    {
        $this->yellowBoxPage->clickCloseButton();
    }

    /**
     * @Then i should not see the expanded yellow-box overlay
     */
    public function iShouldNotSeeTheExpandedYellowBoxOverlay()
    {
        if ($this->yellowBoxPage->isOverlayExpanded()) {
            throw new \Exception('YellowBox overlay is expanded');
        }
    }

    /**
     * @Then i should see storys
     */
    public function iShouldSeeStorys()
    {
        if (!empty($this->yellowBoxPage->getStorys())) {
            throw new \Exception('No storys in YellowBox');
        }
    }

    /**
     * @When i click on approve
     */
    public function iClickOnApprove()
    {
        $this->yellowBoxPage->clickApprove();
    }

    /**
     * @Then i should see an warning message
     */
    public function iShouldSeeAnWarningMessage()
    {
        if (!$this->yellowBoxPage->warningMessageVisible()) {
            throw new \Exception("Warning Message is not visible");
        }
    }

    /**
     * @Then i should see an warning message and an input field
     */
    public function iShouldSeeAnWarningMessageAndAnInputField()
    {
        if (!$this->yellowBoxPage->warningMessageVisible()) {
            throw new \Exception("Warning Message is not visible");
        }

        if (!$this->yellowBoxPage->feedbackFieldIsVisible()) {
            throw new \Exception("Feedback input is not visible");
        }
    }

    /**
     * @When i click on submit
     */
    public function iClickOnSubmit()
    {
        $this->yellowBoxPage->clickOnSubmit();
    }

    /**
     * @Then i should see a success message
     */
    public function iShouldSeeASuccessMessage()
    {
        $this->yellowBoxPage->successMessageVisible();
    }

    /**
     * @When i fill in the reason field
     */
    public function iFillInTheReasonField()
    {
        $this->yellowBoxPage->fillInReasonField();
    }

    /**
     * @Then i cancel the change
     */
    public function iCancelTheChange()
    {
        $this->yellowBoxPage->clickOnCancel();
    }

    /**
     * @When i click on decline
     */
    public function iClickOnDecline()
    {
        $this->yellowBoxPage->clickDecline();
    }
}
