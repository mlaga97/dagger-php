<script type="text/javascript">
	var visibilityKeys = {
		"assessment_type": [
			function(assessment_type) {
				var elements = document.getElementsByClassName("pediatric");
				var display = "";

				switch(assessment_type) {
					case "Adult":
						display = "none";
						break;
					case "Child":
						display = "block";
						break;
				}

				_(elements).each(function(element) {
					element.style.display = display;
				})
			}
		]
	}

	var dagger = {
		jsonAssessment: {
			jsonAssessments: {},
			preassessment: {
				domListener: function(e) {
					if(e.type == "checkbox") {
						if(e.checked) {
							return {key: e.name, value: e.value};
						} else {
							return {key: e.name, value: 0};
						}
					} else {
						return {key: e.name, value: e.value};
					}
				},

				updater: function() {
					var update = dagger.jsonAssessment.preassessment.domListener(this);
					console.log(update.key + " = " + update.value);

					// TODO: FIX THIS
					if(_(visibilityKeys).has(update.key)) {
						_(visibilityKeys[update.key]).each(function(f) {
							f(update.value);
						})
					}
				},

				loader: function(response) {
					// TODO: Handle Errors?
					dagger.jsonAssessment.jsonAssessments = response.response;

					_(dagger.jsonAssessment.jsonAssessments).each(function(jsonAssessment) {
						var metadata = jsonAssessment.metadata;

						var div = document.createElement("div");
						div.className = metadata.class;
						div.title = metadata.title;

						var label = document.createElement("label");

						var input = document.createElement("input");
						input.id = metadata.id;
						input.type = "checkbox";
						input.name = metadata.id;
						input.value = 1;

						var labelText = document.createTextNode(metadata.text);

						label.appendChild(input);
						label.appendChild(labelText);
						div.appendChild(label);

						document.getElementById("assessment_selection").appendChild(div);
					})

					// Iterate over all input elements to add event handlers
					var elements = document.getElementsByTagName('input');
					_(elements).each(function(element) {
						element.addEventListener('change', dagger.jsonAssessment.preassessment.updater, false);
					})
				}
			}
		}
	};

	$.ajax({
		dataType: "json",
		url: "/api/v1/assessment/all",
		data: {},
		success: dagger.jsonAssessment.preassessment.loader
	});

</script>
