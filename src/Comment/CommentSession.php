<?php
namespace Anax\Comment;

/**
* Comment module.
*/
class CommentSession
{

    /**
    * @var array $session inject a reference to the session.
    */
    private $session;


    /**
    * @var string $key to use when storing in session.
    */
    const KEY = "comment";


    /**
    * Inject dependencies.
    *
    * @param array $dependency key/value array with dependencies.
    *
    * @return self
    */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }


    /**
    * Save comments in session.
    *
    * @param array $comments the comments array to save.
    * @return void
    */
    public function saveComments($comments)
    {
        $this->session->set(self::KEY, $comments);
    }
    public function gravatarLink($email)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));
    }


    /**
    * Get and return all comments from session.
    *
    * @return array $comments all comments.
    */
    public function getComments()
    {
        $comments = $this->session->get(self::KEY, []);
        return $comments;
    }


    /**
    * Add comment to all comments and save in session.
    *
    * @param array $newComment the comment to add.
    * @return void
    */
    public function addComment($newComment)
    {
        // Get all comments
        $comments = $this->getComments();

        // Get max value for id
        $max = 0;
        foreach ($comments as $comment) {
            if ($max < $comment["id"]) {
                $max = $comment["id"];
            }
        }
        $newComment["id"] = $max + 1;
        $newComment["gravatarLink"] = $this->gravatarLink($newComment["email"]);

        // Add new comment to all comments
        $comments[] = $newComment;

        // Save comments
        $this->saveComments($comments);
    }


    /**
    * Get comment from array by id.
    *
    * @param int $id the id for the comment
    * @return array|null array with comment if found, else null
    */
    public function getComment($id)
    {
        // Get all comments
        $comments = $this->getComments();

        // Get item from array by id
        $comment = array_filter($comments, function ($key) use ($id) {
            return $key["id"] == $id;
        });

        return (count($comment) > 0) ? array_values($comment)[0] : null;
    }


    public function upsertComment($comment)
    {
        // Get all comments
        $comments = $this->getComments();

        foreach ($comments as $key => $val) {
            if ($val["id"] == $comment["id"]) {
                $comments[$key] = $comment;
                break;
            }
        }
        $this->saveComments($comments);
    }


    public function deleteComment($id)
    {
        // Get all comments
        $comments = $this->getComments();

        // Get item from array by id
        $comments = array_filter($comments, function ($key) use ($id) {
            return $key["id"] != $id;
        });

        if (count($comments) > 0) {
            $this->saveComments($comments);
        } else {
            $this->saveComments([]);
        }
    }
}
