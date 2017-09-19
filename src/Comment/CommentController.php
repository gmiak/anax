<?php
namespace Anax\Comment;

use \Anax\Common\AppInjectableInterface;
use \Anax\Common\AppInjectableTrait;

/**
* A controller for the comment module.
*/
class CommentController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * Reset all comments/session.
     *
     * @return void
     */
    public function getReset()
    {
        $this->app->session->destroy();
        $this->app->redirect("comments");
    }
    /**
     * Get all comments
     *
     * @return void
     */
    public function getComments()
    {
        // Title of page
        $title = "Comments";
        // Get all comments
        $comments = $this->app->comment->getComments();
        // Parse all comments for markdown
        foreach ($comments as $key => $comment) {
            $comments[$key]["text"] = $this->app->textfilter->parse($comment["text"], ["markdown"])->text;
        }
        $this->app->view->add("comment/comments", ["comments" => $comments]);
        $this->app->renderPage(["title" => $title]);
    }
    /**
     * Post a comment
     *
     * @return void
     */
    public function postComment()
    {
        $comment = [];
        $comment["email"] = htmlspecialchars($this->app->request->getPost("email"));
        $comment["text"] = htmlspecialchars($this->app->request->getPost("text"));
        // Add comment to all comments
        $this->app->comment->addComment($comment);

        $this->app->redirect("comments");
    }
    /**
     * Get a singel comment.
     *
     * @param int $id id of comment to get
     * @return void
     */
    public function getComment($id)
    {
        // Get single comment
        $comment = $this->app->comment->getComment($id);

        // Parse comment for markdown
        $comment["text"] = $this->app->textfilter->parse($comment["text"], ["markdown"])->text;

        $title = "Comment # " . $id;
        // Add to view and render
        $this->app->view->add("comment/comment", ["comment" => $comment]);
        $this->app->renderPage(["title" => $title]);
    }
    public function editComment($id)
    {
        $comment = $this->app->comment->getComment($id);
        $title = "Edit comment";
        $this->app->view->add("comment/edit", ["comment" => $comment]);
        $this->app->renderPage(["title" => $title]);
    }
    public function upsertComment()
    {
        $comment = [];
        $comment["id"] = htmlspecialchars($this->app->request->getPost("id"));
        $comment["email"] = htmlspecialchars($this->app->request->getPost("email"));
        $comment["text"] = htmlspecialchars($this->app->request->getPost("text"));
        $this->app->comment->upsertComment($comment);
        $this->app->redirect("comments");
    }
    /**
     * Delete a comment.
     *
     * @param int $id id of comment to delete
     * @return void
     */
    public function deleteComment($id)
    {
        $this->app->comment->deleteComment($id);
        $this->app->redirect("comments");
    }
}
