<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\Twig;

class YellowBoxExtension extends \Twig_Extension
{
    /** @var string */
    private $getTicketsPath;

    /** @var string */
    private $approvePath;

    /** @var string */
    private $declinePath;

    public function __construct(string $getTicketsPath, string $approvePath, string $declinePath)
    {
        $this->getTicketsPath = $getTicketsPath;
        $this->approvePath = $approvePath;
        $this->declinePath = $declinePath;
    }

    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('get_tickets_path', [$this, 'getGetTicketsPath']),
            new \Twig_SimpleFunction('get_approve_path', [$this, 'getApprovePath']),
            new \Twig_SimpleFunction('get_decline_path', [$this, 'getDeclinePath']),
        ];
    }

    public function getGetTicketsPath(): string
    {
        return $this->getTicketsPath;
    }

    public function getApprovePath(): string
    {
        return $this->approvePath;
    }

    public function getDeclinePath(): string
    {
        return $this->declinePath;
    }
}
