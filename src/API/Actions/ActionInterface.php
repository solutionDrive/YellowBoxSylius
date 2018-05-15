<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\API\Actions;

interface ActionInterface
{
    public function getRequestUrl(): string;

    public function getRequestType(): string;

    /**
     * @return string[]
     */
    public function getArguments(): array;
}
