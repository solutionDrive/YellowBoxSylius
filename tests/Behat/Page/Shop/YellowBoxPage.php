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
}
