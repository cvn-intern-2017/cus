

function checkURL(){
  console.log('2');
  var txtInputUrl     = document.getElementById('input_url');
  var valueInputUrl   = txtInputUrl.value;

  if(valueInputUrl == ''){
    document.getElementById("error_client").innerHTML = 'Please input your link';
    return false;
  }
  if(validateURLType(valueInputUrl) && isCharacterUTF8(valueInputUrl) == false){
    if(valueInputUrl.length >= 65234){
      document.getElementById("error_client").innerHTML = 'Make sure the URL is less than 65234 characters';
      return false;
    }
    else{
      return true;
    }
  }
  else{
    document.getElementById("error_client").innerHTML = 'Invalid URL';
    return false;
  }

}

function validateURLType(value){
// permiss in hostname has: . @ -

  if(isWhiteSpaceURL(value) == false){
    var result = value.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);

    if(result == null){
      // Invalid url format
      return false;
    }
    else{
      // Valid url format
      return true;
    }

  }
}

function isWhiteSpaceURL(value){
  var inputURL = new RegExp(" ");
  return inputURL.test(value.trim());
}

function isCharacterUTF8(value){
  for (var i = 0, n = value.length; i < n; i++){
    if (value.charCodeAt( i ) > 127){
      return true;
    }
  }
  return false;
}
