<?php echo '<div id="chronic_data"';
                   if ($_SESSION['grouping']== 10){ echo ' style="display: none;">';} else {echo '>';}
                    echo '
                    
                        <br>
                        <br>
                        <center><h1>Chronic Health Monitoring</h1><p>Please enter the following health information.</p><p>Date format: YYYY/MM/DD</p><p>If you do not have test results to enter, enter "NA" in the results.</p></center>
                        <table id="chronic">
                            <tr><td>
                                    <table border="1" align="center" id="table_sugar">
                                        <tr><th class="tdtopic" colspan="6">Diabetes</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Hemoglobin A1C (%):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueA1C" id="valueA1C"></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input name="A1CDate" id="A1CDate" class="datepickr" placeholder=""></td>
                                        </tr>
                                        <tr><td class="t_name"><label for="eAG">Blood Sugar (eAG) (mg/dl):</label></td>
                                            <td class="t_input"><input type="text" name="valueEAG" id="valueEAG" ></td>
                                            <td class="date_label"><label for="a1c">Test Date:</label></td>
                                            <td class="t_date"><input  name="eAGDate" id="eAGDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_sugar -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_colestoral">
                                        <tr><th class="tdtopic" colspan="6">Cholesterol (mg/dL)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Low-Density Lipoproteins (LDL):</label></td>
                                            <td class="t_input"><input type="text"  name="valueLDL" id="valueLDL"></td>
                                            <td class="t_name"><label for="eAG">High-Density Lipoproteins (HDL):</label></td>
                                            <td class="t_input"><input type="text" name="valueHDL" id="valueHDL"></td>
                                            <td class="date_label"><label for="col_date">Test Date:</label></td>
                                            <td class="t_date"><input name="cholestoralDate" id="cholestoralDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr> 
                            <tr><td>
                                    <table border="1" align="center" id="table_blood">
                                        <tr><th class="tdtopic" colspan="6">Blood Pressure (mm/Hg)</th></tr>
                                        <tr><td class="t_name"><label for="a1c">Systolic:</label></td>
                                            <td class="t_input"><input type="text"  name="valueSYS" id="valueSYS"></td>
                                            <td class="t_name"><label for="eAG">Diastolic:</label></td>
                                            <td class="t_input"><input type="text" name="valueDIA" id="valueDIA"></td>
                                            <td class="date_label"><label for="bp_date">Test Date:</label></td>
                                            <td class="t_date"><input name="bpDate" id="bpDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr>
                            <tr><td>
                                    <table border="1" align="center" id="table_physical">
                                        <tr><th class="tdtopic" colspan="6">Physical</th></tr>
                                        <tr><td class="t_name"><label for="height">Height (inches):</label></td>
                                            <td class="t_input"><input type="text" autofocus="autofocus" name="valueHeight" id="valueHeight"></td>
                                            <td class="t_name"><label for="weight">Weight (lbs.):</label></td>
                                            <td class="t_input"><input type="text" name="valueWeight" id="valueWeight"></td>
                                            <td class="date_label"><label for="weight">Test Date:</label></td>
                                            <td class="t_date"><input type="text"  name="physicalDate" id="physicalDate" class="datepickr" placeholder=""></td>
                                        </tr>                         
                                    </table><!-- close table_a1c -->
                                </td></tr>
                        </table><!-- end table chronic -->
                    </div>';
?><br/>
