<?php foreach($jokes as $joke): ?>
<div class = 'flex'>
  <p class ='flex-child'>
  <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>
  </p>
  <form action="deletejoke.php" method="post" class='flex-child'>
    <input type="hidden" name="id" value="<?=$joke['id']?>">
    <input type="submit" value="Delete">
  </form>
</div>
<?php endforeach; ?>