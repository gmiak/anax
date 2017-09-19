<h1>Comments</h1>

<?php foreach ($comments as $comment) : ?>

    <article class="comment">
      <p> <?= $comment["id"] ?></p>
      <hr>
        <p> <?= $comment["text"] ?></p>
        <p>
        <img src="<?= $comment["gravatarLink"] ?>" alt="">
        <i>By <?= $comment["email"] ?></i>
        </p>
      <hr>

          <div>
              <span><a href=<?= $app->url->create("comment/edit/". $comment["id"]); ?>>Edit </a></span>
              <span><a href=<?= $app->url->create("comment/delete/". $comment["id"]); ?> > Delete</a></span>
          </div>
   </article>
<?php endforeach; ?>



<form action="comment" method="post" class="comment-form">
    <h2>Du kan skriva här!</h2>

    <fieldset>
      <legend>Add a commentary </legend>
        <p><input placeholder="Email" type="email" name="email" required></p>
        <p><textarea name="text" cols="30" rows="10"></textarea></p>
        <p><button type="submit">Post comment</button></p>
  </fieldset>
</form>
