<?php
	$_SESSION['stress_check'] = 0;
	$_SESSION['c_stress_check'] = 0;
	$_SESSION['pp_check'] = 0;
	$_SESSION['events_check'] = 0;
	$_SESSION['health_check'] = 0;
	$_SESSION['symptom_check'] = 0;
	$_SESSION['gad_check'] = 0;
	$_SESSION['phq_check'] = 0;
	$_SESSION['audit_check'] = 0;
	$_SESSION['cage_check'] = 0;
	$_SESSION['cd_check'] = 0;
	$_SESSION['pcl_check'] = 0;
	$_SESSION['psc_check'] = 0;
	$_SESSION['ces_check'] = 0;
	$_SESSION['dast_check'] = 0;
	$_SESSION['GRHOP_standard'] = 0;
	$_SESSION['duke_check'] = 0;
	$_SESSION['self_check'] = 0;
	$_SESSION['gad2_check'] = 0;
	$_SESSION['life_check'] = 0;
	$_SESSION['crafft_check'] = 0;
	$_SESSION['pcl2_check'] = 0;
	$_SESSION['sdq_check'] = 0;
	$_SESSION['diagnosis_check'] = 0;
	$_SESSION['diag_me_check'] = 0;
	$_SESSION['adhd_check'] = 0;

	// Current Grouping is as follows:
	// 1. is for MS test accounts.
	// 2. is for the MS GRHOP
	// 3. is for AL test account.
	// 4. is for FL test account.
	// 5. is for LA test account.
	// 6. is for FNP
	// 7. is for Student Life Success Program.
	//******This needs to be moved into the database.*********//
	//The various menus should be customized and read from the database and displayed based upon how the user logs in.

	if ($_SESSION['grouping'] == 1) { //groupong = 1 is for test accounts.
		echo "
			<div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
				<label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
				<label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"c_stress_check\" input type=\"checkbox\" name=\"c_stress_check\" value=\"1\" /> Child Stressors      </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's presenting problem.\">
				<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" /> Presenting Problem      </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" /> MH Diagnosis         </label>
			</div>
			<div title=\"This section contains questions about what major life events the client has experienced.\">
				<label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
			</div>
			<div title=\"This section contains questions life attitudes.\">
				<label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
			</div>
			<div title=\"This section contains the Crafft substance abuse questions.\">
				<label><input id=\"crafft_check\" input type=\"checkbox\" name=\"crafft_check\" value=\"1\" /> Crafft Substance Abuse         </label>
			</div>
			<div title=\"This section asks questions about the client's current health situation.\">
				<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
			</div>
			<div title=\"This section asks questions about the symptoms the client is currently experiencing.\">
				<label><input id=\"symptom_check\" input type=\"checkbox\" name=\"symptom_check\" value=\"1\" /> PHQ-15     </label>
			</div>
			<div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
				<label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
			</div>
			<div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
				<label><input id=\"gad2_check\"    input type=\"checkbox\" name=\"gad2_check\"    value=\"1\" /> GAD-2          </label>
			</div>
			<div title=\"Patient Depression Questionnaire asks questions concerning depression.\">
				<label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
			</div>
			<div title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
				<label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
			</div>
			<div title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
				<label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
			</div>
			<div title=\"The Connor-Davidson Resilience assessment asks questions concerning client resilience.\">
				<label><input id=\"cd_check\"     input type=\"checkbox\" name=\"cd_check\"     value=\"1\" /> Connor-Davidson</label>
			</div>
			<div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
				<label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
			</div>
			<div title=\"The PCL-C (Civilian and Abbreviated) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
				<label><input id=\"pcl2_check\"    input type=\"checkbox\" name=\"pcl2_check\"    value=\"1\" /> PCL-C (Abbreviated)          </label>
			</div>
			<div title=\"The CES-D is a screening test for depression and depressive disorder. \">
				<label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
			</div>
			<div title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
				<label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
			</div>
			<div title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
				<label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
			</div>
			<div title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
				<label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
			</div>
			<div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
				<label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
			</div>
		";
	} else if ($_SESSION['grouping'] == 2 || $_SESSION['grouping'] == 10) { //grouping = 2 is for the MS GRHOP
		echo "
					<h3>Mental Health</h3>

					<div class=\"childonly\" title=\"This section contains questions pertaining to the client's presenting problem.\">
						<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" /> Presenting Problem      </label>
					</div>

					<div class=\"childonly\" title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
						<label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
					</div>

					<div class=\"childonly\" title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
						<label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
					</div>

					<div  class=\"childonly\" title=\"This section contains questions life attitudes.\">
						<label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
					</div>

					<div class=\"adultonly\" title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
						<label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
					</div>

					<div class=\"adultonly\"  title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
						<label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
					</div>

					<div class=\"adultonly\"  title=\"Patient Depression Questionnaire asks questions concerning depression.\">
						<label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
					</div>

					<!-- Adult and Child -->
					<div title=\"The CES-D is a screening test for depression and depressive disorder. \">
						<label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
					</div>

					<!-- Adult and Child -->
					<div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
						<label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
					</div>

					<div class=\"adultonly\"  title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
						<label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
					</div>

					<!-- Adult and Child -->
					<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
						<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
					</div>

					<div class=\"adultonly\"  title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
						<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" /> MH Diagnosis         </label>
					</div>

					<div class=\"adultonly\"  title=\"This section contains questions about what major life events the client has experienced.\">
						<label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
					</div>

					<!-- Substance Use (Adults only)  -->

					<div class=\"adultonly\" title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
					<h3>Alcohol &amp; Substance Use</h3>
						<label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
					</div>

					<div class=\"adultonly\" title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
						<label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
					</div>

					<div class=\"adultonly\" title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
						<label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
					</div>




					<h3>Health</h3>

					<!-- health_check -->
					<!-- Adult and Child -->
					<div title=\"This section asks questions about the client's current health situation.\">
						<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
					</div>

					<!-- diagnosis_check -->
					<div class=\"adultonly\" title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
						<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
					</div>

					<!-- self_check -->
					<div class=\"adultonly\" title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
						<label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Diabetes Self-Care        </label>
					</div>

					<!-- hypertension h-scale in its own module -->
					<!-- pediatric healthy lifestyles in its own module -->







		";
	} else if ($_SESSION['grouping'] == 6) { //grouping = 6 is for the MS GRHOP non social work students
		echo "
			<div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\" style=\"display: none;\">
				<label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
				<label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis         </label>
			</div>
			<div title=\"This section contains questions about what major life events the client has experienced.\">
				<label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
			</div>
			<div title=\"This section contains questions life attitudes.\" style=\"display: none;\">
				<label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
			</div>
			<div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
				<label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
			</div>
		";
	} else { //default is everything
		echo "
			<div title=\"This section contains questions pertaining to the Strengths and Difficulties Questionnaire (SDQ). It is a brief behavioural screening questionnaire about 3-16 year olds.\">
				<label><input id=\"sdq_check\" input type=\"checkbox\" name=\"sdq_check\" value=\"1\" /> SDQ        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's diabetes self-care behavior.\">
				<label><input id=\"self_check\" input type=\"checkbox\" name=\"self_check\" value=\"1\" /> Self-care        </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" /> Stress         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" /> Diagnosis         </label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis         </label>
			</div>
			<div title=\"This section contains questions about what major life events the client has experienced.\">
				<label><input id=\"events_check\" input type=\"checkbox\" name=\"events_check\" value=\"1\" /> Events         </label>
			</div>
			<div title=\"This section contains questions life attitudes.\">
				<label><input id=\"life_check\" input type=\"checkbox\" name=\"life_check\" value=\"1\" /> Life Attitudes         </label>
			</div>
			<div title=\"This section contains the Crafft substance abuse questions.\">
				<label><input id=\"crafft_check\" input type=\"checkbox\" name=\"crafft_check\" value=\"1\" /> Crafft Substance Abuse         </label>
			</div>
			<div title=\"This section asks questions about the client's current health situation.\">
				<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" /> Health         </label>
			</div>
			<div title=\"This section asks questions about the symptoms the client is currently experiencing.\">
				<label><input id=\"symptom_check\" input type=\"checkbox\" name=\"symptom_check\" value=\"1\" /> PHQ-15     </label>
			</div>
			<div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
				<label><input id=\"gad_check\"    input type=\"checkbox\" name=\"gad_check\"    value=\"1\" /> GAD-7          </label>
			</div>
			<div title = \"The Generalized Anxiety Disorder (GAD) asks questions concerning anxiety.\">
				<label><input id=\"gad2_check\"    input type=\"checkbox\" name=\"gad2_check\"    value=\"1\" /> GAD-2          </label>
			</div>
			<div title=\"Patient Depression Questionnaire asks questions concerning depression.\">
				<label><input id=\"phq_check\"    input type=\"checkbox\" name=\"phq_check\"    value=\"1\" /> PHQ-9          </label>
			</div>
			<div title=\"The Alcohol Use Disorders Identification Test (AUDIT-C) is an alcohol screen that can help identify patients who are hazardous drinkers or have active alcohol use disorders (including alcohol abuse or dependence).\">
				<label><input id=\"audit_check\"  input type=\"checkbox\" name=\"audit_check\"  value=\"1\" /> Audit-C        </label>
			</div>
			<div title=\"The CAGE is a 4- item, relatively non-confrontational questionnaire for detection of alcoholism.\">
				<label><input id=\"cage_check\"   input type=\"checkbox\" name=\"cage_check\"   value=\"1\" /> CAGE           </label>
			</div>
			<div title=\"The Connor-Davidson Resilience assessment asks questions concerning client resilience.\">
				<label><input id=\"cd_check\"     input type=\"checkbox\" name=\"cd_check\"     value=\"1\" /> Connor-Davidson</label>
			</div>
			<div title=\"The PCL-C (civilian) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
				<label><input id=\"pcl_check\"    input type=\"checkbox\" name=\"pcl_check\"    value=\"1\" /> PCL-C          </label>
			</div>
			<div title=\"The PCL-C (Civilian and Abbreviated) asks about symptoms in relation to &quot;stressful experiences.&quot;\">
				<label><input id=\"pcl2_check\"    input type=\"checkbox\" name=\"pcl2_check\"    value=\"1\" /> PCL-C (Abbreviated)          </label>
			</div>
			<div title=\"The CES-D is a screening test for depression and depressive disorder. \">
				<label><input id=\"ces_check\"    input type=\"checkbox\" name=\"ces_check\"    value=\"1\" /> CES-D          </label>
			</div>
			<div title=\"The Pediatric Symptom Checklist-17 (PSC-17) is a psychosocial screen designed to facilitate the recognition of cognitive, emotional, and behavioral problems \">
				<label><input id=\"psc_check\"    input type=\"checkbox\" name=\"psc_check\"    value=\"1\" /> PSC-17          </label>
			</div>
			<div title=\"The Drug Abuse Screen Test (DAST-10) is a 10-item, yes/no self-report instrument that has been condensed from the 28-item DAST. The DAST-10 was designed to provide a brief instrument for clinical screening and treatment evaluation and can be used with adults and older youth.\">
				<label><input id=\"dast_check\"    input type=\"checkbox\" name=\"dast_check\"    value=\"1\" /> DAST-10          </label>
			</div>
			<div title=\"The Duke Health Profile (Duke) is a 17-item generic self-report standardized instrument containing six health measures (physical, mental, social, general, perceived health, and self-esteem), and four dysfunction measures (anxiety, depression, pain, and disability).\">
				<label><input id=\"duke_check\"    input type=\"checkbox\" name=\"duke_check\"    value=\"1\" /> The Duke          </label>
			</div>
			<div title=\"The ADHD Symptom Checklist is an instrument consisting of the eighteen DSM-IV-TR criteria.\">
				<label><input id=\"adhd_check\"    input type=\"checkbox\" name=\"adhd_check\"    value=\"1\" /> ADHD Self-Report Scale          </label>
			</div>
		";
	}
?>
