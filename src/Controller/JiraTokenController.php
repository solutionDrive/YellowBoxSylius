<?php declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace solutionDrive\YellowBox\Controller;

use solutionDrive\YellowBox\API\JiraTokenGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class JiraTokenController extends Controller
{
    public function generateTokenAction(Request $request): Response
    {
        /** @var JiraTokenGenerator $oTokenGenerator */
        $oTokenGenerator = $this->get('tokengeneratorservice');
        $sRequestToken = $request->get('oauth_token');

        if (null !== $sRequestToken) {
            $sToken = $oTokenGenerator->getAccessToken($sRequestToken);
            return $this->render('YellowBoxPlugin::token-generated-success.html.twig', ['token' => $sToken]);
        }

        $sAbsoluteUrl = $this->generateUrl('yellowbox_generate_token', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $sTokenUrl = $oTokenGenerator->getRequestToken($sAbsoluteUrl);
        return $this->redirect($sTokenUrl);
    }
}
