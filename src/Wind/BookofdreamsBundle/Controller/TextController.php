<?php

namespace Wind\BookofdreamsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Wind\BookofdreamsBundle\Entity\Text;
use Wind\BookofdreamsBundle\Form\TextType;

/**
 * Text controller.
 *
 * @Route("/bookofdreams/text")
 */
class TextController extends Controller
{

    /**
     * Lists all Text entities.
     *
     * @Route("/", name="bookofdreams_text")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WindBookofdreamsBundle:Text')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Text entity.
     *
     * @Route("/", name="bookofdreams_text_create")
     * @Method("POST")
     * @Template("WindBookofdreamsBundle:Text:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Text();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bookofdreams_text_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Text entity.
     *
     * @param Text $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Text $entity)
    {
        $form = $this->createForm(new TextType(), $entity, array(
            'action' => $this->generateUrl('bookofdreams_text_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Text entity.
     *
     * @Route("/new", name="bookofdreams_text_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Text();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Text entity.
     *
     * @Route("/{id}", name="bookofdreams_text_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Text entity.
     *
     * @Route("/{id}/edit", name="bookofdreams_text_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
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
    * Creates a form to edit a Text entity.
    *
    * @param Text $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Text $entity)
    {
        $form = $this->createForm(new TextType(), $entity, array(
            'action' => $this->generateUrl('bookofdreams_text_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Text entity.
     *
     * @Route("/{id}", name="bookofdreams_text_update")
     * @Method("PUT")
     * @Template("WindBookofdreamsBundle:Text:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bookofdreams_text_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Text entity.
     *
     * @Route("/{id}", name="bookofdreams_text_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WindBookofdreamsBundle:Text')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Text entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bookofdreams_text'));
    }

    /**
     * Creates a form to delete a Text entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookofdreams_text_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
