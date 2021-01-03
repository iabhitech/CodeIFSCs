// Script for IFSC Search Validation
function searchValidation(e) {
  var ifsc = e.value;
  e.value = ifsc.toUpperCase();
  btnSearch = document.getElementById("btn-search");

  if (ifsc.length == 11) {
    btnSearch.className = "btn btn-outline-white btn-block disabled";
    var req = new XMLHttpRequest();
    // var req = new ActiveXObject("Microsoft.XMLHTTP")
    req.open("POST", "response", true);

    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send("ifsc=" + ifsc);

    req.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        e.className = "form-control " + req.responseText;

        if (req.responseText == "is-valid") btnSearch.className = "btn btn-outline-white btn-block";
        btnSearch.href = "ifsc/" + ifsc.toUpperCase();
      }
    };
  } else {
    btnSearch.className = "btn btn-outline-white btn-block disabled";
    e.className = "form-control is-invalid";
  }
}

//IFSC Search By Address form Validation
function updateState(bankname) {
  bankname = bankname.replace(/ /g, "_");
  window.location = bankname;
}

function updateCity(statename) {
  statename = statename.replace(/ /g, "_");
  window.location = window.location + "/" + statename;
}

function updateBranch(cityname) {
  cityname = cityname.replace(/ /g, "_");
  window.location = window.location + "/" + cityname;
}

function updateSubmit(branchname) {
  branchname = branchname.replace(/ /g, "_");
  document.getElementById("btn-submit").href = window.location + "/" + branchname;
}






/******************** COPY ***************/

//copy
$(function() {
  $('[data-toggle="popover"]').popover()
})
$('.popover-dismiss').popover({
  trigger: 'focus'
})
var cp = document.getElementsByClassName("cpy");
Array.from(cp).forEach((element) => {
  element.addEventListener("click", (e) => {
      tag = e.target.parentNode;
      text = tag.innerHTML;
      var res = '';
      for (i = 0; text[i] != ' '; i++)
          res += text[i];

      //start Copying
      navigator.clipboard.writeText(res).then(function() {
          console.log('Async: Copying to clipboard was successful!');
          $(e.target).val("Code Copied");
          $(e.target).attr('disabled','true');
      }, function(err) {
          console.error('Async: Could not copy text: ', err);
          $(e.target).val("Failed to Copy");
      });
      
    })
  });
  //end copy




/* ********************* Share**************************** */
  function share(e) {
    shareTitle = "Find IFSC, MICR Code, Address of any Bank in India\n";
    shareUrl = window.location.href;
    try {
        t = document.getElementById('shareText').innerHTML;
        shareTitle += "Here is your " + t + "\n";
    } catch (e) {
      console.log("Nothing to Share");
    }

    if (navigator.share) {
        navigator.share({
            url: shareUrl,
            title: shareTitle,
            text: shareTitle
        }).then(function() {
            ga('send', 'event', 'share', 'success');
        }, function(error) {
            ga('send', 'event', 'share', 'error', error);
        });
    }

}