<?php

namespace ProductBundle\Controller\Admin;

use ProductBundle\Entity\AttributeGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Attributegroup controller.
 *
 */
class AttributeGroupController extends Controller
{
    /**
     * Lists all attributeGroup entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attributeGroups = $em->getRepository('ProductBundle:AttributeGroup')->findAll();

        return $this->render('ProductBundle:Admin/AttributeGroup:index.html.twig', array(
            'attributeGroups' => $attributeGroups,
        ));
    }

    /**
     * Creates a new attributeGroup entity.
     *
     */
    public function newAction(Request $request)
    {
        $attributeGroup = new Attributegroup();
        $form = $this
                ->createForm('ProductBundle\Form\AttributeGroupType', $attributeGroup)
                ->add('save', new SubmitType(), [
                    'attr' => [
                        'class' => 'btn btn-sm btn-success',
                    ]
                ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attributeGroup);
            $em->flush($attributeGroup);

            return $this->redirectToRoute('admin_attribute_group_show', array('id' => $attributeGroup->getId()));
        }

        return $this->render('ProductBundle:Admin/AttributeGroup:new.html.twig', array(
            'attributeGroup' => $attributeGroup,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a attributeGroup entity.
     *
     */
    public function showAction(AttributeGroup $attributeGroup)
    {
        $deleteForm = $this->createDeleteForm($attributeGroup);

        return $this->render('ProductBundle:Admin/AttributeGroup:show.html.twig', array(
            'attributeGroup' => $attributeGroup,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing attributeGroup entity.
     *
     */
    public function editAction(Request $request, AttributeGroup $attributeGroup)
    {
        $deleteForm = $this->createDeleteForm($attributeGroup);
        $editForm = $this
                ->createForm('ProductBundle\Form\AttributeGroupType', $attributeGroup)
                ->add('save', new SubmitType(), [
                    'attr' => [
                        'class' => 'btn btn-sm btn-primary',
                    ]
                ]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_attribute_group_edit', array('id' => $attributeGroup->getId()));
        }

        return $this->render('ProductBundle:Admin/AttributeGroup:edit.html.twig', array(
            'attributeGroup' => $attributeGroup,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attributeGroup entity.
     *
     */
    public function deleteAction(Request $request, AttributeGroup $attributeGroup)
    {
        $form = $this->createDeleteForm($attributeGroup);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attributeGroup);
            $em->flush();
        }

        return $this->redirectToRoute('admin_attribute_group_index');
    }

    /**
     * Creates a form to delete a attributeGroup entity.
     *
     * @param AttributeGroup $attributeGroup The attributeGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AttributeGroup $attributeGroup)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_attribute_group_delete', array('id' => $attributeGroup->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
