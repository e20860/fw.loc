<div class="container">
    <br>
    <button class="btn btn-primary" id="send">Кнопка</button>
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
<script src="/fw.loc/public/js/test.js"></script>
<script>
    $( function() {
        $("#send").click(function(){
            $.ajax({
               url:     "http://php.st/fw.loc/main/test",
               type:    "post",
               data:    {'id': 2},
               success: function(res){
                   console.log(res);
               },
               error:   function(xhr, ajaxOptions, thrownError) {
                   console.log(thrownError);
               }
            });
        });
    });
</script>

