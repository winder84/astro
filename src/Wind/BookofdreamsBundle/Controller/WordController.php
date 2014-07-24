<?php

namespace Wind\BookofdreamsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Wind\BookofdreamsBundle\Entity\Word;
use Wind\BookofdreamsBundle\Form\WordType;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Word controller.
 *
 * @Route("/bookofdreams/word")
 */
class WordController extends Controller
{
	private $pageCount = 20;

    /**
     * Lists all Word entities.
     *
     * @Route("/", name="bookofdreams_word")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($page)
    {
		if ($page < 0) {
			$page = 0;
		}
		$em = $this->getDoctrine()->getManager();
		$dql = "SELECT w FROM WindBookofdreamsBundle:Word w";
		$query = $em->createQuery($dql)
			->setFirstResult($page * $this->pageCount)
			->setMaxResults($this->pageCount);

		$paginator = new Paginator($query, $fetchJoinCollection = true);
		$count = count($paginator);
		return array(
			'entities' => $paginator,
			'page' => $page,
			'count' => round($count / $this->pageCount),
		);
    }
    /**
     * Creates a new Word entity.
     *
     * @Route("/", name="bookofdreams_word_create")
     * @Method("POST")
     * @Template("WindBookofdreamsBundle:Word:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Word();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bookofdreams_word_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Word entity.
     *
     * @param Word $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Word $entity)
    {
        $form = $this->createForm(new WordType(), $entity, array(
            'action' => $this->generateUrl('bookofdreams_word_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Word entity.
     *
     * @Route("/new", name="bookofdreams_word_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Word();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Word entity.
     *
     * @Route("/{id}", name="bookofdreams_word_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Word')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Word entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Word entity.
     *
     * @Route("/{id}/edit", name="bookofdreams_word_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Word')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Word entity.');
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
    * Creates a form to edit a Word entity.
    *
    * @param Word $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Word $entity)
    {
        $form = $this->createForm(new WordType(), $entity, array(
            'action' => $this->generateUrl('bookofdreams_word_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Word entity.
     *
     * @Route("/{id}", name="bookofdreams_word_update")
     * @Method("PUT")
     * @Template("WindBookofdreamsBundle:Word:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WindBookofdreamsBundle:Word')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Word entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bookofdreams_word_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Word entity.
     *
     * @Route("/{id}", name="bookofdreams_word_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WindBookofdreamsBundle:Word')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Word entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bookofdreams_word'));
    }

    /**
     * Creates a form to delete a Word entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookofdreams_word_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
