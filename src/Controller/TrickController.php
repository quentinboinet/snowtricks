<?php


namespace App\Controller;


use App\Entity\Trick;
use App\Repository\TrickRepository;
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
            $tricks = "";
        }
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/loadMore", name="get_more_tricks", methods={"POST"})
     */
    public function getMoreTricks(Request $request, TrickRepository $trickRepository)
    {
        if ($request->isXmlHttpRequest())
        {
            $tricks = $trickRepository->showMoreTricks($request->request->get('offset'));

            $arrayCollection = array();
            foreach($tricks as $trick) {
                $pictures = $trick->getPictures();
                if (count($pictures) != 0) {
                    $i=0;
                    foreach ($pictures as $picture) {
                        if ($i==0) { $picturePath = $picture->getPath(); } //on récupère la première image associée à ce trick (image de couverture)
                        $i++;
                    }
                } else {$picturePath = ""; }

                $arrayCollection[] = array(
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                    'pictures' => $picturePath,
                );
            }
            return new JsonResponse($arrayCollection);
        }
    }
}