<div class="container">
    <?php if(!empty($posts)): ?>
    <?php foreach ($posts as $post) : ?>
        <div class="card" >
         <div class="card-body">
           <h5 class="card-title"><?= $post['title'] ?></h5>
           <p class="card-text"><?= substr($post['content'],0,250); ?></p>
         </div>
       </div>   
    
    <?php endforeach; ?>
 }
    <?php endif; ?>
</div>
