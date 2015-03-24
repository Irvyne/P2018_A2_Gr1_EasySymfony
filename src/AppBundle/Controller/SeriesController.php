<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Series;
use AppBundle\Form\SeriesType;

/**
 * Series controller.
 *
 * @Route("/series")
 */
class SeriesController extends Controller
{

    /**
     * Lists all Series entities.
     *
     * @Route("/", name="series")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $series = $em->getRepository('AppBundle:Series')->findAll();

        return $this->render('AppBundle:Series:index.html.twig', [
            'series' => $series,
        ]);
    }

    /**
     * Creates a new Series entity.
     *
     * @Route("/create", name="series_create")
     * @Method("GET|POST")
     */
    public function createAction(Request $request)
    {
        $series = new Series();
        $form = $this->createForm(new SeriesType(), $series, array(
            'action' => $this->generateUrl('series_create'),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Create'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($series);
            $em->flush();

            return $this->redirect($this->generateUrl('series_show', array('id' => $series->getId())));
        }

        return $this->render('AppBundle:Series:new.html.twig', [
            'series' => $series,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a Series entity.
     *
     * @Route("/{id}", name="series_show")
     * @Method("GET")
     */
    public function showAction(Series $series)
    {
        $deleteForm = $this->createDeleteForm($series->getId());

        return $this->render('AppBundle:Series:show.html.twig', [
            'series'      => $series,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Edits an existing Series entity.
     *
     * @Route("/update/{id}", name="series_update")
     * @Method("GET|PUT")
     */
    public function updateAction(Request $request, Series $series)
    {
        $em = $this->getDoctrine()->getManager();

        $deleteForm = $this->createDeleteForm($series->getId());
        $editForm = $this->createForm(new SeriesType(), $series, array(
            'action' => $this->generateUrl('series_update', array('id' => $series->getId())),
            'method' => 'PUT',
        ));
        $editForm->add('submit', 'submit', array('label' => 'Update'));
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('series'));
        }

        return $this->render('AppBundle:Series:edit.html.twig', [
            'series'      => $series,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a Series entity.
     *
     * @Route("/{id}", name="series_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Series')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Series entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('series'));
    }

    /**
     * Creates a form to delete a Series entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('series_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
