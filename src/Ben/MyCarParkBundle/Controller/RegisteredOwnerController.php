<?php

namespace Ben\MyCarParkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ben\MyCarParkBundle\Entity\RegisteredOwner;
use Ben\MyCarParkBundle\Form\RegisteredOwnerType;

/**
 * RegisteredOwner controller.
 *
 * @Route("/registeredowner")
 */
class RegisteredOwnerController extends Controller
{

    /**
     * Lists all RegisteredOwner entities.
     *
     * @Route("/", name="registeredowner")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BenMyCarParkBundle:RegisteredOwner')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new RegisteredOwner entity.
     *
     * @Route("/", name="registeredowner_create")
     * @Method("POST")
     * @Template("BenMyCarParkBundle:RegisteredOwner:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RegisteredOwner();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('registeredowner_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a RegisteredOwner entity.
     *
     * @param RegisteredOwner $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RegisteredOwner $entity)
    {
        $form = $this->createForm(new RegisteredOwnerType(), $entity, array(
            'action' => $this->generateUrl('registeredowner_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RegisteredOwner entity.
     *
     * @Route("/new", name="registeredowner_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RegisteredOwner();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RegisteredOwner entity.
     *
     * @Route("/{id}", name="registeredowner_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:RegisteredOwner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisteredOwner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RegisteredOwner entity.
     *
     * @Route("/{id}/edit", name="registeredowner_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:RegisteredOwner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisteredOwner entity.');
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
    * Creates a form to edit a RegisteredOwner entity.
    *
    * @param RegisteredOwner $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RegisteredOwner $entity)
    {
        $form = $this->createForm(new RegisteredOwnerType(), $entity, array(
            'action' => $this->generateUrl('registeredowner_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RegisteredOwner entity.
     *
     * @Route("/{id}", name="registeredowner_update")
     * @Method("PUT")
     * @Template("BenMyCarParkBundle:RegisteredOwner:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:RegisteredOwner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegisteredOwner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registeredowner_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a RegisteredOwner entity.
     *
     * @Route("/{id}", name="registeredowner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BenMyCarParkBundle:RegisteredOwner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RegisteredOwner entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('registeredowner'));
    }

    /**
     * Creates a form to delete a RegisteredOwner entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registeredowner_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
