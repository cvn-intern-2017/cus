<div class="container">
    <div class="clean100"></div>
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="row">
                <form class="col s12" action="" method="post">
                    <div class="row">
                        <div class="input-field col s9">
                            <input placeholder="Nhập link cần rút gọn" name="link" id="input_url" type="text" class="validate">
                        </div>
                        <div class="input-field col s3">
                            <a data-target="modal1" class="waves-effect waves-light btn-large btn" >Shorten URL</a>
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
<script language="JavaScript">
    function check(){
        var txt = document.getElementById('input_url');
        var a = txt.value;
        var res = a.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        if(res == null){

            alert("This is NOT url");
        }
        else{
            alert("This is url");
    }
</script>

<script type="text/javascript" src="UI/js/jquery-2.1.1.min.js">

</script>
<script src="UI/js/materialize.min.js">

</script>

