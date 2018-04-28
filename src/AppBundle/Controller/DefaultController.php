<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Template("default/index.html.twig")
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('user_new'),
            'method' => 'post',
        ]);
        $form->add('save', SubmitType::class);

        return [
            'form' => $form->createView(),
            'errors' => $request->getSession()->getFlashBag()->get('errors'),
        ];
    }

    /**
     * @Route("/user_new", name="user_new")
     * @author Robert Glazer
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('user_new'),
            'method' => 'post'
        ]);
        $form->add('save', SubmitType::class);

        $form->handleRequest($request);

        if (
            $form->isSubmitted() &&
            $form->isValid()
        ) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('success', ['id' => $user->getId()]);
        }

        foreach ($form->getErrors(true) as $error) {
            $this->get('session')->getFlashBag()->add('errors', $error->getMessage());
        }
        return $this->redirectToRoute('homepage', []);
    }

    /**
     * @Route("/success/{id}", name="success")
     * @param int $id
     * @author Robert Glazer
     * @Template("default/register_success.html.twig")
     * @return array
     */
    public function registerSuccessAction($id)
    {
        $user = $this->container->get('doctrine')->getRepository('AppBundle:User')->find($id);
        return [
            'user' => $user,
        ];
    }

}
