<h1>Comment # <?= $comment["id"] ?></h1>



<article class="comment">

    <p> <?= $comment["text"] ?></p>

    <footer>
        <img src="<?= $comment["gravatarLink"] ?>" alt="">
        <p>by <?= $comment["email"] ?></p>
    </footer>
</article>
