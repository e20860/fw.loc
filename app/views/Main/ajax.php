<div class="container">
    <br>
    <?php if(!empty($post)): ?>
        <div class="card" >
         <div class="card-body">
           <h5 class="card-title"><?= $post['title'] ?></h5>
           <p class="card-text"><?= substr($post['content'],0,500); ?></p>
         </div>
       </div>   
    <?php endif; ?>
</div>
