function validateForm() {
  var x_coord = document.forms["controlForm"]["x_coord"].value;
  var y_coord = document.forms["controlForm"]["y_coord"].value;
  if (x_coord == "") {
    alert("Please specify an X coordinate!");
    return false;
  }
  if (y_coord == "") {
    alert("Please specify a Y coordinate!");
    return false;
  }
}


function confirmRestart() {
    confirm("Are you sure you want to start a new game?");
}
