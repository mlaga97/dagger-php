<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script> -->

<script type="text/javascript">
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
				},

				loader: function(jsonAssessments) {
					dagger.jsonAssessment.jsonAssessments = jsonAssessments;

					_(dagger.jsonAssessment.jsonAssessments).each(function(jsonAssessment) {
						var metadata = jsonAssessment.metadata;

						var div = document.createElement("div");
						div.class = metadata.class;
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
		url: "/modules/jsonAssessment/dumpAssessments.php",
		data: {},
		success: dagger.jsonAssessment.preassessment.loader
	});

</script>
