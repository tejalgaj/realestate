function fileread(file) {
  var fsize = file.files[0].size;
  var fname = file.files[0].name;
  var ftype = file.files[0].type;
  var fielArray = ["image/png", "image/jpeg", "image/gif", "image/jpg"];
  var fileTrue = fielArray.indexOf(ftype);
  if (fileTrue >= 0) {
    var reader = new FileReader();
    reader.element = $(file).parent().find("thumb");
    reader.onload = function (e) {
      var div = document.getElementById("thumb");
      div.innerHTML =
        "<img class='thumb' src='" +
        e.target.result +
        "'" +
        "title='" +
        fname +
        "'/>";

      var formData = new FormData();
      for (var i = 0; i < file.files.length; i++) {
        var fileup = file.files[i];
        // Check the file type.
        if (!fileup.type.match("image.*")) {
          continue;
        }
        // Add the file to the request.
        formData.append("filename[]", fileup, fileup.name);
      }
      uploadajax(formData);
    };
    reader.onerror = function (e) {
      alert("error: " + e.target.error.code);
    };
    reader.readAsDataURL(file.files[0]);
  } else {
    document.getElementById("error").innerHTML =
      "Incorrect file format, Please select an image file format..";
  }
}

function uploadajax(formData) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "upload.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      //console.log(xhr.responseText);
    } else {
      alert("An error occurred!");
    }
  };

  xhr.upload.addEventListener("progress", imageprogress, false);
  xhr.addEventListener("load", Completed, false);
  xhr.addEventListener("error", failstatus, false);
  xhr.addEventListener("abort", Abortedstatus, false);
  xhr.send(formData);
}

function imageprogress(event) {
  document.getElementById("complete").style.display = "none";
  document.getElementById("progress_status").style.display = "block";
  //document.getElementById("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
  var percent = (event.loaded / event.total) * 100;
  document.getElementById("status").value = Math.round(percent);
  $("#progressbar").progressbar({
    value: document.getElementById("status").value,
  });
  document.getElementById("status").innerHTML = Math.round(percent) + "%";
}
