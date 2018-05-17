<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\Twig;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductVariantInterface;

class YellowBoxExtension extends \Twig_Extension
{
    /** @var string */
    private $getTicketsPath;

    /** @var string */
    private $approvePath;

    /** @var string */
    private $declinePath;

    /**
     * YellowBoxExtension constructor.
     * @param string $getTicketsPath
     * @param string $approvePath
     * @param string $declinePath
     */
    public function __construct(string $getTicketsPath, string $approvePath, string $declinePath)
    {
        $this->getTicketsPath = $getTicketsPath;
        $this->approvePath = $approvePath;
        $this->declinePath = $declinePath;
    }


    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('get_tickets_path', [$this, 'getGetTicketsPath']),
            new \Twig_SimpleFunction('get_approve_path', [$this, 'getApprovePath']),
            new \Twig_SimpleFunction('get_decline_path', [$this, 'getDeclinePath']),
        ];
    }

    /**
     * @return string
     */
    public function getGetTicketsPath(): string
    {
        return $this->getTicketsPath;
    }

    /**
     * @return string
     */
    public function getApprovePath(): string
    {
        return $this->approvePath;
    }

    /**
     * @return string
     */
    public function getDeclinePath(): string
    {
        return $this->declinePath;
    }
}
