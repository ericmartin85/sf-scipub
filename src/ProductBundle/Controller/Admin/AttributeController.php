<?php

namespace ProductBundle\Controller\Admin;

use ProductBundle\Entity\Attribute;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Attribute controller.
 *
 */
class AttributeController extends Controller
{
    /**
     * Lists all attribute entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attributes = $em->getRepository('ProductBundle:Attribute')->findAll();

        return $this->render('ProductBundle:Admin/Attribute:index.html.twig', array(
            'attributes' => $attributes,
        ));
    }

    /**
     * Creates a new attribute entity.
     *
     */
    public function newAction(Request $request)
    {
        $attribute = new Attribute();
        $form = $this
                ->createForm('ProductBundle\Form\AttributeType', $attribute)
                ->add('save', new SubmitType(), [
                    'attr' => [
                        'class' => 'btn btn-sm btn-success',
                    ]
                ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attribute);
            $em->flush($attribute);

            return $this->redirectToRoute('admin_attribute_show', array('id' => $attribute->getId()));
        }

        return $this->render('ProductBundle:Admin/Attribute:new.html.twig', array(
            'attribute' => $attribute,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attribute entity.
     *
     */
    public function showAction(Attribute $attribute)
    {
        $deleteForm = $this->createDeleteForm($attribute);

        return $this->render('ProductBundle:Admin/Attribute:show.html.twig', array(
            'attribute' => $attribute,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attribute entity.
     *
     */
    public function editAction(Request $request, Attribute $attribute)
    {
        $deleteForm = $this->createDeleteForm($attribute);
        $editForm = $this
                ->createForm('ProductBundle\Form\AttributeType', $attribute)
                ->add('save', new SubmitType(), [
                    'attr' => [
                        'class' => 'btn btn-sm btn-primary',
                    ]
                ]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_attribute_edit', array('id' => $attribute->getId()));
        }

        return $this->render('ProductBundle:Admin/Attribute:edit.html.twig', array(
            'attribute' => $attribute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attribute entity.
     *
     */
    public function deleteAction(Request $request, Attribute $attribute)
    {
        $form = $this->createDeleteForm($attribute);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attribute);
            $em->flush();
        }

        return $this->redirectToRoute('admin_attribute_index');
    }

    /**
     * Creates a form to delete a attribute entity.
     *
     * @param Attribute $attribute The attribute entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attribute $attribute)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_attribute_delete', array('id' => $attribute->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
