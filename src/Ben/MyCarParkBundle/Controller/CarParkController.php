<?php

namespace Ben\MyCarParkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ben\MyCarParkBundle\Entity\CarPark;
use Ben\MyCarParkBundle\Form\CarParkType;

/**
 * CarPark controller.
 *
 * @Route("/carpark")
 */
class CarParkController extends Controller
{

    /**
     * Lists all CarPark entities.
     *
     * @Route("/", name="carpark")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BenMyCarParkBundle:CarPark')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Creates a new CarPark entity.
     *
     * @Route("/", name="carpark_create")
     * @Method("POST")
     * @Template("BenMyCarParkBundle:CarPark:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CarPark();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carpark_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CarPark entity.
     *
     * @param CarPark $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CarPark $entity)
    {
        // Creates frm fields basd on the entity
        $form = $this->createForm(new CarParkType(), $entity, array(
            'action' => $this->generateUrl('carpark_create'),
            'method' => 'POST',
        ));
        
        // Adds a Submit button to the bottom of the form
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CarPark entity.
     *
     * @Route("/new", name="carpark_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CarPark();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CarPark entity.
     *
     * @Route("/{id}", name="carpark_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:CarPark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarPark entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CarPark entity.
     *
     * @Route("/{id}/edit", name="carpark_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:CarPark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarPark entity.');
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
    * Creates a form to edit a CarPark entity.
    *
    * @param CarPark $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CarPark $entity)
    {
        $form = $this->createForm(new CarParkType(), $entity, array(
            'action' => $this->generateUrl('carpark_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * Edits an existing CarPark entity.
     *
     * @Route("/{id}", name="carpark_update")
     * @Method("PUT")
     * @Template("BenMyCarParkBundle:CarPark:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BenMyCarParkBundle:CarPark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CarPark entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('carpark_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a CarPark entity.
     *
     * @Route("/{id}", name="carpark_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BenMyCarParkBundle:CarPark')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CarPark entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carpark'));
    }

    /**
     * Creates a form to delete a CarPark entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carpark_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
