<?php

namespace Ben\MyCarParkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ben\MyCarParkBundle\Entity\Driver;
use Ben\MyCarParkBundle\Form\DriverType;

/**
 * Driver controller.
 *
 * @Route("/driver")
 */
class DriverController extends Controller
{

    /**
     * Lists all Driver entities.
     *
     * @Route("/", name="driver")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BenMyCarParkBundle:Driver')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Driver entity.
     *
     * @Route("/", name="driver_create")
     * @Method("POST")
     * @Template("BenMyCarParkBundle:Driver:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Driver();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('driver_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Driver entity.
     *
     * @param Driver $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Driver $entity)
    {
        $form = $this->createForm(new DriverType(), $entity, array(
            'action' => $this->generateUrl('driver_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Driver entity.
     *
     * @Route("/new", name="driver_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Driver();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Driver entity.
     *
     * @Route("/{id}", name="driver_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Driver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Driver entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Driver entity.
     *
     * @Route("/{id}/edit", name="driver_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Driver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Driver entity.');
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
    * Creates a form to edit a Driver entity.
    *
    * @param Driver $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Driver $entity)
    {
        $form = $this->createForm(new DriverType(), $entity, array(
            'action' => $this->generateUrl('driver_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Driver entity.
     *
     * @Route("/{id}", name="driver_update")
     * @Method("PUT")
     * @Template("BenMyCarParkBundle:Driver:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:Driver')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Driver entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('driver_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Driver entity.
     *
     * @Route("/{id}", name="driver_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BenMyCarParkBundle:Driver')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Driver entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('driver'));
    }

    /**
     * Creates a form to delete a Driver entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('driver_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
