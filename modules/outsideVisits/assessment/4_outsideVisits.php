<?php
	echo '<div id="questions"';if ($_SESSION['grouping']== 10){ echo ' style="display: none;">';} else {echo '>';}
                       echo' <center><h1>Outside Visits</h1></center>
                        <br>
                        <p><STRONG>1</STRONG>: Since your last visit and other than Emergency Room visit, have you been in the hospital?
                            <INPUT TYPE="radio"  id="q1_1" NAME="q1" VALUE="yes" onclick="show(this, \'q1_fu\');">Yes
                            <INPUT TYPE="radio"  id="q1_2" NAME="q1" VALUE="no"  onclick="show(this, \'q1_fu\');">No</p>
                        <div id="q1_fu" style="display:none;">
                            <p><strong>Date of discharge: </strong>
                                <input type="date"  name="hospital_visit_date" id="hospital_visit_date" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for visit:</strong>
                                 <select name="hospital_visit_reason" id="hospital_visit_reason" onchange="updateDiv(this.value)">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select> 
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                                <input type="text"  name="hospital_visit_other" id="hospital_visit_other" maxlength="150" size="150">
                            </p>

                        </div>
                        <p><STRONG>2</STRONG>: Since your last visit have you been to the Emergency Room?
                            <INPUT TYPE="radio" id= "q2_1" NAME="q2" VALUE="yes" onclick="show(this, \'q2_fu\');">Yes
                            <INPUT TYPE="radio" id= "q2_2" NAME="q2"  VALUE="no"  onclick="show(this, \'q2_fu\');">No</p>
                        <div id="q2_fu" style="display:none;">
                            <p><strong>Date of ER visit:</strong>
                                <input type="date"  name="er_visit_date" id="er_visit_date" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for ER visit:</strong>
                                 <select name="er_visit_reason" id="er_visit_reason">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select> 
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                               <input type="date"  name="er_visit_other" id="er_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p><STRONG>3</STRONG>: Since your last visit have you been to the another medical provider?
                            <INPUT TYPE="radio" id= "q3_1" NAME="q3" VALUE="yes" onclick="show(this, \'q3_fu\');">Yes
                            <INPUT TYPE="radio" id="q3_2"  NAME="q3"  VALUE="no"  onclick="show(this, \'q3_fu\');">No</p>
                        <div id="q3_fu" style="display:none;">
                            <p><strong>Date of office visit:</strong>
                                <input type="date"  name="office_visit_date" id="office_visit_date" placeholder=""> (format: YYYY/MM/DD)
                            </p>
                            <p><strong>Reason for office visit:</strong>
                                 <select name="office_visit_reason" id="office_visit_reason">
                                    <option value="Nothing Selected"></option>
                                    <option value="Chronic Condition Related">Chronic Condition Related</option>
                                    <option value="Accident">Accident</option>
                                    <option value="Other">Other</option>
                                </select>
                            </p>
                            <p>
                                If other, what was the specific reason? (Maximum 150 characters)
                            </p>
                            <p>
                                <input type="text"  name="office_visit_other" id="office_visit_other" maxlength="150" size="150">
                            </p>
                        </div>
                        <p>    
                    </div>
';
?><br/>
