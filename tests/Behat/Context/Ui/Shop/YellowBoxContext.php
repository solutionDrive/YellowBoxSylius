<?php

declare(strict_types=1);

namespace Tests\solutionDrive\YellowBox\Behat\Context\Ui\Shop;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Tests\solutionDrive\YellowBox\Behat\Page\Shop\YellowBoxPage;
use Tests\solutionDrive\YellowBox\Behat\Services\YellowBoxParameter;
use Webmozart\Assert\Assert;

final class YellowBoxContext implements Context
{
    /**
     * @var YellowBoxPage
     */
    private $yellowBoxPage;

    /**
     * YellowBoxContext constructor.
     * @param YellowBoxPage $yellowBoxPage
     */
    public function __construct(YellowBoxPage $yellowBoxPage)
    {
        $this->yellowBoxPage = $yellowBoxPage;
    }

    /**
     * @When there is no yellowbox cookie
     */
    public function thereIsNoYellowboxNoCookie()
    {
        $this->yellowBoxPage->clearYellowBoxCookie();
    }

    /**
     * @When I am on the homepage
     */
    public function iAmOnTheHomepage()
    {
        $this->yellowBoxPage->open();
    }

    /**
     * @Then I should be on the homepage
     */
    public function iShouldBeOnTheHomepage()
    {
        if (!$this->yellowBoxPage->isOpen()) {
            throw new \Exception('I am not on the Homepage');
        };
    }

    /**
     * @Then I should see the yellow-box overlay
     * @Given I see the yellow-box overlay
     */
    public function iShouldSeeTheYellowBoxOverlay()
    {
        if (!$this->yellowBoxPage->overlayExists()) {
            throw new \Exception('YellowBox ist nicht auf der Seite');
        }
    }

    /**
     * @When I click on the yellow-box symbol
     */
    public function iClickOnTheYellowBoxSymbol()
    {
        $this->yellowBoxPage->clickOverlaySymbol();
    }

    /**
     * @Then I should see the expanded yellow-box overlay
     */
    public function iShouldSeeTheExpandedYellowBoxOverlay()
    {
        if (!$this->yellowBoxPage->isOverlayExpanded()) {
           throw new \Exception('YellowBox overlay is not expanded');
        }
    }

    /**
     * @Then I click on the close button
     */
    public function iClickOnTheCloseButton()
    {
        $this->yellowBoxPage->clickCloseButton();
    }

    /**
     * @Then I should not see the expanded yellow-box overlay
     */
    public function iShouldNotSeeTheExpandedYellowBoxOverlay()
    {
        if ($this->yellowBoxPage->isOverlayExpanded()) {
            throw new \Exception('YellowBox overlay is expanded');
        }
    }

    /**
     * @Then I should see storys
     */
    public function iShouldSeeStorys()
    {
        if (empty($this->yellowBoxPage->getStorys())) {
            throw new \Exception('No storys in YellowBox');
        }
    }

    /**
     * @When I click on approve
     */
    public function iClickOnApprove()
    {
        $this->yellowBoxPage->clickApprove();
    }

    /**
     * @Then I should see a warning message
     */
    public function iShouldSeeAnWarningMessage()
    {
        if (!$this->yellowBoxPage->warningMessageVisible()) {
            throw new \Exception("Warning Message is not visible");
        }
    }

    /**
     * @Then I should not see a warning message
     */
    public function iShouldNotSeeAnWarningMessage()
    {
        if ($this->yellowBoxPage->warningMessageVisible()) {
            throw new \Exception("Warning Message is visible");
        }
    }

    /**
     * @Then I should see a warning message and an input field
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
     * @When I click on submit
     */
    public function iClickOnSubmit()
    {
        $this->yellowBoxPage->clickOnSubmit();
    }

    /**
     * @When I fill in the reason field
     */
    public function iFillInTheReasonField()
    {
        $this->yellowBoxPage->fillInReasonField();
    }

    /**
     * @Then I cancel the change
     * @Then I should be able to cancel the change
     */
    public function iCancelTheChange()
    {
        $this->yellowBoxPage->clickOnCancel();
    }

    /**
     * @When I click on decline
     */
    public function iClickOnDecline()
    {
        $this->yellowBoxPage->clickDecline();
    }
}
