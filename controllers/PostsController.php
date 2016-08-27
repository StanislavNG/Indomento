<?php

class PostsController extends BaseController
{
    function OnInIt() {
        $this->authorize();
    }

    function index()
    {
        $this->posts = $this->model->getAll();
    }

    function create()
    {
        if ($this->isPost) {
            $title = $_POST['post_title'];
            if (strlen($title) < 1) {
                $this->setValidationError("post_title", "Title cannot be empty!");
            }

            $content = $_POST['post_content'];
            if (strlen($content) < 1) {
                $this->setValidationError("post_content", "Content cannot be empty!");
            }
            if ($this->formValid()) {
                $userId = $_SESSION['user_id'];
                if ($this->model->create($title, $content, $userId)) {
                    $this->addInfoMessage("Post created.");
                    $this->redirect("posts");
                } else {
                    $this->addErrorMessage("Error: cannot create post.");
                }
            }

        }

    }

    function delete(int $id)
    {

       if ($this->isPost) {
           if ($this->model->delete($id)) {
               $this->addInfoMessage("Post deleted!");
           }
           else
           {
               $this->addErrorMessage("Error: cannot delete post!");
           }
           $this->redirect('posts');
       }
        else
        {
            $post = $this->model->getPostById($id);
            if (! $post) {
                $this->addErrorMessage("Error: post does not exist!");
                $this->redirect('posts');
            }
            $this->post = $post;
        }
    }

    function edit(int $id) {

        if ($this->isPost)
        {
            if($this->model->edit())
        }
        else
        {
            $post = $this->model->getPostById($id);
            if (! $post) {
                $this->addErrorMessage("Error: post does not exist!");
                $this->redirect('posts');
            }
            $this->post = $post;
        }
    }
}
