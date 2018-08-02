<?php
/**
 *PHP version 5.6
 *
 *My_Blog v1.00
 *
 *@author Mohamed Yousef <engineer.mohamed.yossef@gmail.com>
 *@copyright (C) My_Blog 2018
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MyBlogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $posts = $manager->getRepository("AppBundle:Posts")->getPosts();
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        return $this->render('index.html.twig', array("posts" => $posts, "categories" => $categories));
    }

    /**
     * @Route("/post/{post_id}/{post_title}", name="post")
     */
    public function postAction(Request $request, $post_id, $post_title)
    {
        $add_comment = $request->request->get('add-comment');
        $comment_email = $request->request->get('comment-email');
        $comment_body = $request->request->get('comment-body');

        $manager = $this->getDoctrine()->getManager();
        $post = $manager->getRepository("AppBundle:Posts")->getPostbById($post_id);
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        $comments = $manager->getRepository("AppBundle:Comments")->getComments($post_id);
        if (!count($comments))
            $comments = null;
        
        if (isset($add_comment)) {
            if ($comment_body != "" && filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
                $manager = $this->getDoctrine()->getManager();
                $manager->getRepository("AppBundle:Comments")->insertComment($post_id, $comment_email, $comment_body);

                return $this->redirect($request->getUri());
            } else {
                $this->addFlash(
                    'notice',
                    'Invaild Comment :('
                );

                return $this->redirect($request->getUri());
            }
        }

        return $this->render('post.html.twig', array("post" => $post, "comments" => $comments, "categories" => $categories));
    }

    /**
     * @Route("/category/{cat_name}", name="category")
     */
    public function categoryAction(Request $request, $cat_name)
    {
        $manager = $this->getDoctrine()->getManager();
        $posts = $manager->getRepository("AppBundle:Posts")->getPostsbByCat($cat_name);
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        return $this->render('cat.html.twig', array("cat_name" => $cat_name, "posts" => $posts, "categories" => $categories));
    }

    /**
     * @Route("/add-post", name="add-post")
     */
    public function addPostAction(Request $request)
    {
        $session = $request->getSession();
        $is_login = $session->get('is_login');

        if ($is_login != 1) {
            $this->addFlash(
                'notice',
                'Illegal Request :('
            );

            $url = $this->generateUrl('homepage');
            return $this->redirect($url);
        }

        $add = $request->request->get('add');

        $post_title    = $request->request->get('post-title');
        $post_category = $request->request->get('post-category');
        $post_content  = $request->request->get('post-content');
        
        $manager = $this->getDoctrine()->getManager();
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        if (isset($add)) {
            if ($post_title == "" || $post_content == "" || $post_category == "--Select--") {
                return $this->render('newPost.html.twig', array("error" => true, "categories" => $categories));
            } else {
			    $manager->getRepository("AppBundle:Posts")->insertPost($post_title, $post_content, $post_category);
                
                $this->addFlash(
                    'notice',
                    'Your post were added succefuly!'
                );

                 $url = $this->generateUrl('homepage');

                 return $this->redirect($url);
            }  
        } 

        return $this->render('newPost.html.twig', array("error" => false, "categories" => $categories));
    }

    /**
     * @Route("/add-category", name="add-category")
     */
    public function addCatagoryAction(Request $request)
    {
        $session = $request->getSession();
        $is_login = $session->get('is_login');

        if ($is_login != 1) {
            $this->addFlash(
                'notice',
                'Illegal Request :('
            );

            $url = $this->generateUrl('homepage');
            return $this->redirect($url);
        }

        $add = $request->request->get('add');
        $category_name = $request->request->get('cat-name');

        $manager = $this->getDoctrine()->getManager();
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();
        
        if (isset($add)) {
            if ($category_name == "") {
                return $this->render('newCat.html.twig', array("error" => true, "categories" => $categories));
            } else {
			    $manager->getRepository("AppBundle:Categories")->insertCategory($category_name);
                
                $this->addFlash(
                    'notice',
                    'Your category were added succefuly!'
                );

                 $url = $this->generateUrl('homepage');

                 return $this->redirect($url);
            }  
        } 

        return $this->render('newCat.html.twig', array("error" => false, "categories" => $categories));
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $_username = "admin";
        $_password = "123";

        $ok = $request->request->get('ok');
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $manager = $this->getDoctrine()->getManager();
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        if (isset($ok)) {
            if ($username == "" || $password == "") {
                return $this->render('login.html.twig', array("error" => true, "categories" => $categories));
            } else {
			    if ($username == $_username && $password == $_password) {
                    $session = $request->getSession();
                    $session->set('is_login', 1);
                    
                    $this->addFlash(
                        'notice',
                        'Welcome Back Admin :)'
                    );

                    $url = $this->generateUrl('control-panel');

                    return $this->redirect($url);
                } else {
                    return $this->render('login.html.twig', array("error" => true, "categories" => $categories));
                }
            }  
        } 

        return $this->render('login.html.twig', array("error" => false, "categories" => $categories));
    }

    /**
     * @Route("/cp", name="control-panel")
     */
    public function cpAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $categories = $manager->getRepository("AppBundle:Categories")->getCategories();

        $session = $request->getSession();
        $is_login = $session->get('is_login');

        if ($is_login == 1) {
            return $this->render('cp.html.twig', array("categories" => $categories));
        } else {
            $this->addFlash(
                'notice',
                'Illegal Request :('
            );

            $url = $this->generateUrl('homepage');
            return $this->redirect($url);
        }
    }
}
