<?php

namespace Ben\MyCarParkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ben\MyCarParkBundle\Entity\Stay;
use Ben\MyCarParkBundle\Form\StayType;

/**
 * Stay controller.
 *
 * @Route("/stay")
 */
class StayController extends Controller
{

    /**
     * Lists all Stay entities.
     *
     * @Route("/", name="stay")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BenMyCarParkBundle:Stay')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Stay entity.
     *
     * @Route("/", name="stay_create")
     * @Method("POST")
     * @Template("BenMyCarParkBundle:Stay:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Stay();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stay_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Stay entity.
     *
     * @param Stay $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stay $entity)
    {
        $form = $this->createForm(new StayType(), $entity, array(
            'action' => $this->generateUrl('stay_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Stay entity.
     *
     * @Route("/new", name="stay_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stay();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stay entity.
     *
     * @Route("/{id}", name="stay_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Stay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stay entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stay entity.
     *
     * @Route("/{id}/edit", name="stay_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Stay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stay entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Stay entity.
    *
    * @param Stay $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Stay $entity)
    {
        $form = $this->createForm(new StayType(), $entity, array(
            'action' => $this->generateUrl('stay_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Stay entity.
     *
     * @Route("/{id}", name="stay_update")
     * @Method("PUT")
     * @Template("BenMyCarParkBundle:Stay:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Stay')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stay entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stay_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stay entity.
     *
     * @Route("/{id}", name="stay_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BenMyCarParkBundle:Stay')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stay entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stay'));
    }

    /**
     * Creates a form to delete a Stay entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stay_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
