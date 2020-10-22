
<?= $this->getContent() ?>
<div class="right_col" role="main">
<div class="jumbotron">
    <h1>Page not found</h1>
    <p>Sorry, you have accessed a page that does not exist or was moved</p>
    <p><?= $this->tag->linkTo(['home', 'Home', 'class' => 'btn btn-primary']) ?></p>
</div>
</div>    
