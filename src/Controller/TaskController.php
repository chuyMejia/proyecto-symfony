<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Entity\User;


use Symfony\Component\HttpFoundation\Request;

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
public function detail2(Task $task = null)
{
    if (!$task) {
        throw $this->createNotFoundException('Task not found');
    }

    return $this->render('task/detail.html.twig', [
        'task' => $task
    ]);
}



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



}
