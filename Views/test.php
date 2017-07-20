  <div class="container">
    <div class="clean100"></div>
		<div class="row">
			<div class="col s6 offset-s3">
        <div class="row">
          <form class="col s12" action="index.php" method="post">
            <div class="row">
              <div class="input-field col s9">
                <input placeholder="Nhập link cần rút gọn" type="text" class="validate" id="input_url" name="link">
              </div>
              <div class="input-field col s3">
                <input type="submit" class="waves-effect waves-light btn-large btn" onclick="check()" value="Shorten URL"/>
              </div>
            </div>
          </form>
        </div>
		  </div>
    </div>

<?php
 if(isset($newLink) && isset($createdDate) && isset($originalLink) && isset($createdBrowser) ){
   ?>
   <div class="row">
     <div class="col s12">
       <div class="clean100"></div>
       <table>
         <thead>
           <tr>
               <th>Created Time</th>
               <th>Original Link</th>
               <th>Shorten Link</th>
               <th>Browser</th>
               <th></th>
           </tr>
         </thead>

         <tbody>
           <tr>
             <td><?php echo $createdDate;?></td>
             <td><?php echo $originalLink;?></td>
             <td><a href=<?php echo htmlspecialchars($newLink);?>><?php echo $newLink;?></a></td>
             <td><?php echo $createdBrowser;?></td>
             <td><a class="btn-floating waves-effect waves-light red"><i class="tiny material-icons">insert_chart</i></a></td>
           </tr>
         </tbody>
       </table>

     </div>
   </div>
   <?php
 }
 else{

   echo '';
 }

 ?>




	</div>
