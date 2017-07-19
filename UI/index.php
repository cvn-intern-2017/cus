<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title>ShortenURL</title>
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<nav>
    <div class="nav-tabs">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html">Sass</a></li>
            <li><a href="badges.html">Components</a></li>
            <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <form class="col s12" action="index.php">
            <div class="row">

                <div class="input-field col s6">
                    <input placeholder="Your original URL here" type="text" class="validate">
                    <a class="waves-effect waves-light btn" id="myBtn">Shorten</a>

                </div>
            </div>

        </form>
    </div>
</div>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="txt">Your Short URL</p>
        <div class="mydiv2">
            <p class="text">cybozu.vn/V2pMaf</p>
        </div>
        <div class="div-btnDone">
            <a class="waves-effect waves-light btn" id="btnDone">Done</a>
        </div>

    </div>

</div>
<script src="myjs.js"></script>

</body>
</html>