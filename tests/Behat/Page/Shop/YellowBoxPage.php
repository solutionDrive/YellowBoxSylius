<?php

declare(strict_types=1);

namespace Tests\solutionDrive\YellowBox\Behat\Page\Shop;

use GuzzleHttp\Client;
use Sylius\Behat\Page\SymfonyPage;

class YellowBoxPage extends SymfonyPage
{

    public function open(array $urlParameters = [])
    {
        parent::open($urlParameters);
        $this->getDocument()->waitFor(400, function () {
            if (empty($this->getDocument()->find('css', '#yellow-box .ui.dimmer.active'))) {
                return true;
            }
            return false;
        });

        sleep(1);
    }

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
        sleep(2);
    }

    public function isOverlayExpanded()
    {
        return !empty($this->getDocument()->find('css', '#yellow-box.expanded'));
    }

    public function clickCloseButton()
    {
        $this->getDocument()->find('css', '#yellow-box')->click();
        sleep(1);
    }

    public function getStorys()
    {
        return $this->getDocument()->findAll('css', '#yellow-box .story');
    }

    public function clickApprove()
    {
        $this->getDocument()->find('css', '#yellow-box .button.accept')->click();
        sleep(1);
    }

    public function clickDecline()
    {
        $this->getDocument()->find('css', '#yellow-box .button.decline')->click();
        sleep(1);
    }

    public function warningMessageVisible()
    {
        if (
            $this->getDocument()->find('css', '.modal.decline')->isVisible() ||
            $this->getDocument()->find('css', '.modal.accept')->isVisible()
        ) {
            return true;
        }
        return false;
    }

    public function feedbackFieldIsVisible()
    {
        return $this->getDocument()->find('css', '.modal.decline textarea')->isVisible();
    }

    public function clickOnSubmit()
    {
        $acceptModal = $this->getDocument()->find('css','.modal.accept');
        if ($acceptModal->isVisible()) {
            $acceptModal->find('css','.button.approve')->click();
        } else {
            $declineModal = $this->getDocument()->find('css','.modal.decline');
            $declineModal->find('css','.button.approve')->click();
        }
        sleep(1);
    }

    public function clickOnCancel()
    {
        $acceptModal = $this->getDocument()->find('css','.modal.accept');
        if ($acceptModal->isVisible()) {
            $acceptModal->find('css', '.button.cancel')->click();
        } else {
            $declineModal = $this->getDocument()->find('css','.modal.decline');
            $declineModal->find('css','.button.cancel')->click();
        }
        sleep(1);
    }

    public function fillInReasonField()
    {
        $this->getDocument()->fillField('decline_reason', 'Test Reason 123');
    }

    public function clearYellowBoxCookie()
    {
        $this->getDriver()->setCookie('yellowbox-state', 'false');
    }

    public function assetsAreLoaded()
    {
        $curl = curl_init("/assets/shop/css/style.css");

        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return 400 !== $httpCode && 0 !== $httpCode;
    }
}
