<?php

declare(strict_types=1);

namespace Tests\solutionDrive\YellowBox\Behat\Page\Shop;

use Sylius\Behat\Page\SymfonyPage;

class YellowBoxPage extends SymfonyPage
{
    /**
     * {@inheritdoc}
     */
    public function overlayExists(): bool
    {
        return !empty($this->getDocument()->find('css', '#yellow-box'));
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName(): string
    {
        return 'sylius_shop_homepage';
    }

    public function clickOverlaySymbol()
    {
        $this->getDocument()->find('css', '#yellow-box')->click();
    }

    public function isOverlayExpanded()
    {
        return !empty($this->getDocument()->find('css', '#yellow-box.expanded'));
    }

    public function clickCloseButton()
    {
        $this->getDocument()->find('css', '#yellow-box #close');
    }

    public function getStorys()
    {
        return $this->getDocument()->find('css', '#yellow-box .story');
    }

    public function clickApprove()
    {
        $this->getDocument()->find('css', '#yellow-box #approve')->click();
    }

    public function clickDecline()
    {
        $this->getDocument()->find('css', '#yellow-box #decline')->click();
    }

    public function warningMessageVisible()
    {
        $this->getDocument()->find('css', '#yellow-box .modal')->isVisible();
    }

    public function feedbackFieldIsVisible()
    {
        $this->getDocument()->find('css', '#yellow-box .modal input')->isVisible();
    }

    public function clickOnSubmit()
    {
        $this->getDocument()->find('css','#yellow-box #submit')->click();
    }

    public function clickOnCancel()
    {
        $this->getDocument()->find('css','#yellow-box #cancel')->click();
    }

    public function fillInReasonField()
    {
        $this->getDocument()->fillField('#yellow-box input', 'Test Reason 123');
    }

    public function successMessageVisible()
    {
        $this->getDocument()->find('css', '#success.ui.popup')->isVisible();
    }
}
