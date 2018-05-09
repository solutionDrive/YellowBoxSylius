<?php

/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 06.02.17
 * Time: 11:22
 */
namespace solutionDrive\YellowBox\API\Actions;

interface ActionInterface
{
    public function getRequestUrl() : string;
    public function getRequestType() : string;
    public function getArguments() : array;
}
