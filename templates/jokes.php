<div class="flex">
<p><b><?=$totalJokes?> jokes</b> have been submitted so far </p>
</div>
<?php foreach($jokes as $joke): ?>
<div class = 'flex'>
  <p class ='flex-child'>
  
  <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>

  <b>by: <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES,'UTF-8'); ?>"><?=htmlspecialchars($joke['name'], ENT_QUOTES,'UTF-8'); ?></a>
  </b>
  on
  <?php
    $date = new DateTime($joke['jokedate']);
    echo $date->format('jS F Y');
  ?>

  </p>
  <a href="/joke/edit?id=<?=$joke['id']?>" id='edit' class='flex-child' >Edit</a>
  <form action="/joke/delete" method="post"class='flex-child'>
    <input type="hidden" name="id" value="<?=$joke['id']?>">
    <input type="submit" value="Delete">
  </form>
</div>
<?php endforeach; ?>