<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskController extends AbstractController
{
   
    public function index(): Response
    {

        //prueba de entidades y relaciones 


        $em =$this->getDoctrine()->getManager();
        
        
        $task_repo =$this->getDoctrine()->getRepository(Task::class);
        $tasks =   $task_repo->findBy([],['id' => 'DESC']);
        /*
          foreach($tasks as $task ){
            echo $task->getUser()->getEmail().':'.$task->getTitle()."</br>";

          }
        */

       /* $user_repo = $this->getDoctrine()->getRepository(User::class);
        $users = $user_repo->findAll();
        foreach($users as $user ){
            echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";
            foreach($user->getTasks() as $task){
                echo  $task->getTitle()."<br/>";
            }
        }*/




        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

     /**
 * @Route("/tarea/{id}", name="task_detail")
 */
public function detail2(Task $task )
{


    if (!$task) {
        throw $this->createNotFoundException('Task not found');
    }

    return $this->render('task/detail.html.twig', [
        'task' => $task
    ]);
}


//\
public function detail($id){

    //load repository

    $task_repo = $this->getDoctrine()->getRepository(Task::class);
    //cosulta
    $task = $task_repo->find($id);

    //cpmprapbar result

    if (!$task) {
        throw $this->createNotFoundException('Task not found');
    }


    return $this->render('task/detail.html.twig', [
        'task' => $task
    ]);

}


public function creation(Request $request, \Symfony\Component\Security\Core\User\UserInterface $user){

    $task = new Task();

    $form = $this->createForm(TaskType::class, $task);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $task->setCreateAt(new \DateTime('now'));
        $task->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->redirect(
            $this->generateUrl('task_detail',['id'=> $task->getId()])
        );

    }

    return $this->render('task/creation.html.twig',[
        'form'=>$form->createView()
       
    ]);

}



    public function myTasks(UserInterface $user){
       $tasks =  $user->getTasks();
       //var_dump($tasks);

       //die();
       return $this->render('task/my-tasks.html.twig',[
        'tasks' =>  $tasks
       ]);

    }

    /**
     * @Route("/editar-tarea/{id}", name="task_edit", methods={"GET", "POST"})
     */
   // src/Controller/TaskController.php

public function edit(Request $request, UserInterface $user, $id): Response
{
    $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

    if (!$task || !$user || $user->getId() !== $task->getUser()->getId()) {
        return $this->redirectToRoute('tasks');
    }

    $form = $this->createForm(TaskType::class, $task);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
       // $task->setCreateAt(new \DateTime('now'));
      //  $task->setUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->redirectToRoute('task_detail', ['id' => $task->getId()]);
    }

    return $this->render('task/creation.html.twig', [
        'edit' => true,
        'form' => $form->createView(),
    ]);
}

public function delete(Request $request,UserInterface $user,$id){


    $task = $this->getDoctrine()->getRepository(Task::class)->find($id);

    if (!$task || !$user || $user->getId() !== $task->getUser()->getId()) {
        return $this->redirectToRoute('tasks');
    }

   


    $em = $this->getDoctrine()->getManager();
    $em->remove($task);
    $em->flush();

    return $this->redirectToRoute('tasks');






}



}
