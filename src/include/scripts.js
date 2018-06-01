
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
      if(req) {
        inputs[j].setAttribute("required", "");
      }
      else {
        inputs[j].removeAttribute("required");
      } // End if-else req
    } // End if hassClass noreq
  } // End for loop
} // End fxn toggleRequired


function sendFocus(receiving_inputID) {
  input_obj = document.getElementById(receiving_inputID);
  input_obj.focus();
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

// Checkbox toggle for another input field
// Checked: enables another input, sets focus
// Unchecked: clears value and disables
// Accepts checkbox object (toggle) and an input id to be enabled/disabled
function cb_toggleField(cb_obj, input_id) {
  var affected = document.getElementById(input_id);
  if (cb_obj.checked) {
    affected.disabled = false;
    affected.focus();
  } else {
    // if disabling, clear value
    if (affected.value != "") {
      affected.value = "";
    }
    affected.disabled = true;
  }

} // End cb_toggleField fxn

// Checkbox toggle for No Response on text input
// Checked: set value "No Response" (for user feedback, not passed to DB), disable primary field, enable hidden No Response field
// Unchecked: clear primary field value (if needed), enable primary field, disable hidden No Response field, focus primary filed
// Accepts checkbox object, primary field id, secondary hidden field id
function cb_noResponse(cb_obj, primary_id, hidden_id) {
  var primary = document.getElementById(primary_id);
  var hidden = document.getElementById(hidden_id);
  // if no response, set value "No Response", disable primary, enable hidden
  if (cb_obj.checked) {
    primary.value = "No Response";
    primary.disabled = true;
    hidden.disabled = false;

  } else {
    // if response, clear value, enable, focus
    if (primary.value != "") {
      primary.value = "";
    }
    primary.disabled = false;
    hidden.disabled = true;
    primary.focus();
  }  //End if else
} // End cb_noResponse fxn


// WhatIF: A group of inputs in toggled div are displayed, given values and then toggled back to hidden -- clear input values
function clearFields(div_containerID) {
    var containingDiv_obj = document.getElementById(div_containerID);
    var selects = containingDiv_obj.getElementsByTagName('select');

    for(var i=0, len=selects.length; i < len; i++) {
        selects[i].selectedIndex = -1;
    }

    var fields = containingDiv_obj.getElementsByTagName('input');
    for(var i=0, len=fields.length; i < len; i++) {
        var field = fields[i];
        switch(field.type)
        {
            case 'radio':
            case 'checkbox':
                field.checked = false;
                break;
            case 'number':
            case 'date':
                field.value = null;
                break;
            case 'text':
            case 'password':
            case 'hidden':
                field.value = ''
        }
    }

    var fields = containingDiv_obj.getElementsByTagName('textarea');
    for(var i=0, len=fields.length; i < len; i++) {
        fields[i].value = ''
    }
}

// Would like to do something with this to warn against leaving page with out submit
/*
window.addEventListener("beforeunload", function (e) {
  var confirmationMessage = "\o/";

  e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
  return confirmationMessage;              // Gecko, WebKit, Chrome <34
});

*/
