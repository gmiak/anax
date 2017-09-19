<h1>Redigera kommentar # <?= $comment["id"] ?></h1>


<form action="<?= $app->url->create("comment/edit") ?>" method="post" class="comment-form">
    <input type="hidden" name="id" value="<?= $comment["id"] ?>">
    <p>
    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email" required value="<?= $comment["email"] ?>">
    </div>
  </p>

  <p>
    <div>
        <label for="text">Comment</label><br>
        <textarea name="text" cols="30" rows="10"><?= $comment["text"] ?></textarea>
    </div>

    <button type="submit">Save comment</button>
  </p>
</form>
