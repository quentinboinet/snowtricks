<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var FlashBagInterface
     */
    private $flash;

    public function __construct(UserRepository $userRepository, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder, FlashBagInterface $flash)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->flash = $flash;
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'app_login' && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        // Ma clé privée
        $secret = "6Lfe6rMUAAAAAJJywYLtiOkocjIsr63SrMiyKLgD";
        // Paramètre renvoyé par le recaptcha
        $response = $request->request->get('g-recaptcha-response');
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {
            // C'est un humain
            $credentials = [
                'username' => $request->request->get('username'),
                'password' => $request->request->get('password'),
                'csrf_token' => $request->request->get('_csrf_token'),
            ];
            $request->getSession()->set(
                Security::LAST_USERNAME,
                $credentials['username']
            );

            return $credentials;
        }
        else {
            throw new InvalidCsrfTokenException();
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->userRepository->findOneBy(['username' => $credentials['username']]);
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $user2 = $this->userRepository->findOneBy(['username' => $credentials['username']]);
        if ($user2->getStatus() === 0)
        {
            $this->flash->add('fail', 'Votre compte est inactif ! Veuillez l\'activer via le lien reçu par e-mail, ou <a href="/api/resendRegistrationToken/' . $user2->getId() . '">me renvoyer un lien</a>');
            throw new DisabledException();
            return new RedirectResponse($this->router->generate('home_page'));
        }
        else {
            return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        }
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) { //si on souhaitait accéder à une autre page avant de se connecter
            return new RedirectResponse($targetPath);
        }

        $this->flash->add('success', 'Vous êtes désormais connecté !');

        return new RedirectResponse($this->router->generate('home_page'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('app_login');
    }
}
