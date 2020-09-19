<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\FizzBuzz\FizzBuzz;
use App\Entity\Etudiant;
use App\Entity\Module;
use App\Entity\Note;
use App\Form\Type;
use App\Form\Type\addNoteType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class FizzBuzzController extends AbstractController
{

    /**
     * @Route("/blog", name="blog_list")
     */
    public function list(Request $request)
    {
        $students = $this->getDoctrine()->getRepository(Etudiant::class)->findAll();
        $modules = $this->getDoctrine()->getRepository(Module::class)->findAll();

        foreach ($students as $student) {
            $dataStudent[$student->getNomEtudiant() . ' ' . $student->getPrenomEtudiant()] = $student->getId();
        }
        foreach ($modules as $module) {
            $dataModule[$module->getNomModule()] = $module->getId();
        }
        $note = $this->createForm(addNoteType::class, ['student_choice' => $dataStudent, 'module_choice'  => $dataModule,]);

        $note->handleRequest($request);


        if ($note->isSubmitted() && $note->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            dump($note->getData());
            die;

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('note.html.twig', [
            'form' => $note->createView(),
        ]);
        dump($students);
        die;
        // ...
    }
}
