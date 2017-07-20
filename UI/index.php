<!DOCTYPE html>
<html>
<head>
  <meta charset="ISO-8859-1">
  <title>Shorten URL</title>
  <link rel="stylesheet" href="css/materialize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <nav>
    <div class="container">
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Cybozu</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href=".">Home</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="clean100"></div>
		<div class="row">
			<div class="col s6 offset-s3">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s9">
                <input placeholder="Nhập link cần rút gọn" type="text" class="validate">
              </div>
              <div class="input-field col s3">
                <a data-target="modal1" class="waves-effect waves-light btn-large btn">Shorten URL</a>
              </div>
            </div>

          </form>
        </div>
		  </div>
    </div>


		<div id="modal1" class="modal" style="width:40%">
      <div class="modal-content">
        <span>Shorten URL:</span>&nbsp;&nbsp;&nbsp;
        <code style="background:#DDD; height:50px;">http://cus.dev.cybozu.xyz/Wf94v9</code>
      </div>
      <div class="modal-footer">
        <a href="https://goo.gl/#analytics/goo.gl/gwZsEL/all_time" target="_blank" class="waves-effect waves-green btn-flat">Analytics</a>
        <a class="modal-action modal-close waves-effect waves-green btn-flat">Done</a>
      </div>
    </div>
	</div>
  

<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<script> 
  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('#modal1').modal();
  });
</script>
</body>
</html>