<?php
/**
 * Created by PhpStorm.
 * User: jnoack
 * Date: 08.05.18
 * Time: 11:55
 */

namespace solutionDrive\YellowBox\Controller;

use solutionDrive\YellowBox\API\JiraTokenGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Cookie;

class JiraTokenController extends Controller
{
    private $aToken = null;
    public function generateTokenAction(Request $request)
    {
        /** @var JiraTokenGenerator $oTokenGenerator */
        $oTokenGenerator = $this->get('tokengeneratorservice');
        $sRequestToken = $request->get('oauth_token');

        if ($sRequestToken !== null) {
            $sToken = $oTokenGenerator->getAccessToken($sRequestToken);
            //dump($this->checkToken($sToken));
            die($sToken);
            return $this->redirectToRoute('sylius_shop_homepage');
        }

        $sAbsoluteUrl = $this->generateUrl('yellowbox_generate_token', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $sTokenUrl = $oTokenGenerator->getRequestToken($sAbsoluteUrl);
        return $this->redirect($sTokenUrl);
    }

    public function checkTokenAction()
    {
        $oClient = $this->get('JiraService');
        $oResponse = $oClient->getUser();
        return $oResponse->getStatusCode();
        if ($oResponse->getStatusCode() === 200) {
            return true;
        }
        return false;
    }
}