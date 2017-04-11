
//Mitigates problem with browsers that treat input type date as type text; format to ISO format - IE11, Firefox
function formatDate(input_obj) {
var inputDate = new Date(input_obj.value);
  try {
	var ISODate = inputDate.toISOString().substr(0, 10);
	input_obj.value = ISODate;
  }
  catch(err) { }
}


function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}


// Sets all inputs within containingDiv_obj to required or not based on req=true or false
function toggleRequired(containingDiv_obj, req) {
  var inputs = containingDiv_obj.getElementsByTagName("input");
  var setting = false;
  if (req==true) {
    setting = true;
  }
  for (var j = 0; j < inputs.length; j++){
    // exclude for inputs with class 'noreq' -- Outside Visits other reason text input may be hidden - requiring hidden input locks form.
    if (hasClass(inputs[j], 'noreq') == false){
    //inputs[j].required = setting;
    inputs[j].setAttribute("required", setting);
    }
  }
}

// Show / Hide div blocks activated by Y/N toggles -- optional argument sets all input attributes to required=true or false
// Required arguments divID and show (true/false)
// Optional argument req (true/false) toggles input required attribute
function toggleDisplay(divID, show, req) {
  var div_obj = document.getElementById(divID);
  var displaySetting = 'none';
  if (show == true) {
    displaySetting = 'block';
  }
  div_obj.style.display = displaySetting;
  if (req == true || req == false) {
    toggleRequired(div_obj, req);
  }
}
