<script language="JavaScript">
    function check(){
      var txt = document.getElementById('input_url');
      var a = txt.value;
        var res = a.match(/(http(s)?:\/\/.)(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
      if(a.length<=256){
        if(res == null){
            alert("This is NOT url");
            return false;
        }
        else{
          /*
          $(document).ready(function(){
            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            //add được record trong url table mới hiển thị popup
            $('#modal1').modal();
          });
*/
        }
      }else{
            alert("Input is so long!!!");
      }
      var a = null;
    }
</script>
<script type="text/javascript" src="UI/js/jquery-2.1.1.min.js"></script>
<script src="UI/js/materialize.min.js"></script>
<footer class="light-blue lighten-1">
    <p class="copyright">Cybozu URL Shortener Copyright &copy; 2017 Cybozu. All rights reserved </p>
</footer>
</body>
</html>
