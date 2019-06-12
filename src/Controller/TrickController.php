<?php


namespace App\Controller;


use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TrickController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function home(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $tricks = $repository->findBy([], ['updatedAt' => 'DESC'], 15); //On récupère les 15 derniers tricks

        if (!$tricks) {
            throw $this->createNotFoundException(sprintf('Aucun article trouvé !'));
        }
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/loadMore", name="get_more_tricks", methods={"POST"})
     */
    public function getMoreTricks(Request $request, EntityManagerInterface $em)
    {
        if ($request->isXmlHttpRequest())
        {
            $repository = $em->getRepository(Trick::class);
            $tricks = $repository->showMoreTricks($_POST['offset']);

            $arrayCollection = array();
            foreach($tricks as $trick) {
                $arrayCollection[] = array(
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                );
            }
            return new JsonResponse($arrayCollection);
        }
    }
}