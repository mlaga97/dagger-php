<?php if ($_SESSION['grouping']== 10){ echo '<div id="demo_data" <?php style="display: none;">';} else {echo '<div id="demo_data">';}
                    echo '        
                            <h1><center>Demographic Data</center></h1><p><center>Complete applicable information.</center>
                        <table id="demo">
                            <tr><td>
                                    <table border="1" align="center" id="table_sex">
                                        <tr><th class="tdtopic" colspan="4">Gender</th></tr>
                                        <tr><td class="sf">Male</td><td class="demo_input"><center><input type="radio" name="sex"  value="male"/></center></td>
                                <td class="sf">Female</td><td class="demo_input"><center><input type="radio" name="sex"  value="female"/></center></td></tr>
                            <tr><td class="sf">Transgender</td><td class="demo_input"><center><input type="radio" name="sex"  value="transgender"/></center></td>
                            <td class="sf">Other</td><td class="demo_input"><center><input type="radio" name="sex"  value="other"/></center></td></tr>
                        </table><!-- close table sex -->
                        </td>';
                    if ($_SESSION['assessment_type'] == "Adult"){
                        echo ' <td><table border="1" align="center" id="table_marital">
                                <tr><th class="tdtopic" colspan="4">Marital Status</th></tr>
                                <tr><td class="ms">Single.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="single"/></center></td>
                        <td class="ms">Married.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="married"/></center></td></tr>
                        <tr><td class="ms">Divorced.</td><td class="demo_input"><center><input type="radio" name="m_status"  value="divorced"/></center></td>
                        <td class="ms">Widow(ed).</td><td class="demo_input"><center><input type="radio" name="m_status"  value="widow(ed)"/></center></td></tr>
                        </table>
                        </td></tr>';
                    }
                           
                    if ($_SESSION['assessment_type'] == "Adult"){   
                        echo '<tr><td colspan="2">
                                <table border="1" id="table_education">
                            <tr><th class="tdtopic" colspan="4">Education</th></tr>
                            <tr><td class="ed">Elementary/Jr. high school.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Elementary/Jr. high school"/></center></td>
                                <td class="ed">2-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="2-year degree"/></center></td></tr>
                            <tr><td class="ed">Some high school.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Some high school"/></center></td>
                                <td class="ed">4-year degree.</td><td class="demo_input"><center><input type="radio" name="ed"  value="4-year degree"/></center></td></tr>
                            <tr><td class="ed">High school diploma or GED.</td><td class="demo_input"><center><input type="radio" name="ed"  value="High school diploma or GED"/></center></td>
                                <td class="ed">More than 4 years college.</td><td class="demo_input"><center><input type="radio" name="ed"  value="More than 4 years college"/></center></td></tr>
                            <tr><td class="ed">Some college.</td><td class="demo_input"><center><input type="radio" name="ed"  value="Some college"/></center></td><td class="ed" border="0"></td><td></td></tr>
                        </table>			
                        </td></tr>';
                    } 
                    else {
                         echo '<tr><td colspan="2">
                                <table border="1" id="table_education">
                            <tr><th class="tdtopic" colspan="24">Education: Highest grade completed</th></tr>
                            <tr><td class="c_ed" align="right">1</td><td class="demo_input"><center><input type="radio" name="ed"  value="1"/></center></td>
                                <td class="c_ed" align="right">2</td><td class="demo_input"><center><input type="radio" name="ed"  value="2"/></center></td>
                                <td class="c_ed" align="right">3</td><td class="demo_input"><center><input type="radio" name="ed"  value="3"/></center></td>
                                <td class="c_ed" align="right">4</td><td class="demo_input"><center><input type="radio" name="ed"  value="4"/></center></td>
                                <td class="c_ed" align="right">5</td><td class="demo_input"><center><input type="radio" name="ed"  value="5"/></center></td>
                                <td class="c_ed" align="right">6</td><td class="demo_input"><center><input type="radio" name="ed"  value="6"/></center></td>
                                <td class="c_ed" align="right">7</td><td class="demo_input"><center><input type="radio" name="ed"  value="7"/></center></td>
                                <td class="c_ed" align="right">8</td><td class="demo_input"><center><input type="radio" name="ed"  value="8"/></center></td>
                                <td class="c_ed" align="right">9</td><td class="demo_input"><center><input type="radio" name="ed"  value="9"/></center></td>
                                <td class="c_ed" align="right">10</td><td class="demo_input"><center><input type="radio" name="ed"  value="10"/></center></td>
                                <td class="c_ed" align="right">11</td><td class="demo_input"><center><input type="radio" name="ed"  value="11"/></center></td>
                                <td class="c_ed" align="right">12</td><td class="demo_input"><center><input type="radio" name="ed"  value="12"/></center></td></tr>    
                        </table>			
                        </td></tr>
                        <tr><td colspan="2">
                                <table border="1" id="table_birth_order">
                                    <tr><th class="tdtopic" colspan="8">Birth Order</th></tr>
                                    <tr><td class="bo">Oldest. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Oldest"/></center></td>
                                        <td class="bo">Youngest. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Youngest"/></center></td>
                                        <td class="bo">Middle. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Middle"/></center></td>
                                        <td class="bo">Twin. </td><td class="demo_input"><center><input type="radio" name="c_bo"  value="Twin"/></center></td>
                                    </tr>
                                </table>			
                        </td></tr>';   
                        }
                        echo '<tr><td colspan="2">
                                <table border="1" id="table_ethnicity">
                                    <tr><th class="tdtopic" colspan="6">Ethnicity</th></tr>
                                    <tr><td class="eth">White/Caucasian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="White/Caucasian"/></center></td>
                            <td class="eth">Native Hawaiian/Pacific Islander.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Native Hawaiian/Pacific Islander"/></center></td>
                        <td class="eth">Black/African-American.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Black/African-American"/></center></td></tr>
                        <tr><td class="eth">Hispanic/Latino.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Hispanic/Latino"/></center></td>
                        <td class="eth">Middle Eastern.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Middle Eastern"/></center></td>
                        <td class="eth">American Indian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="American Indian"/></center></td></tr>
                        <tr><td class="eth">Asian.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Asian"/></center></td>
                        <td class="eth">Vietnamese.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Vietnamese"/></center></td>
                        <td>Other.</td><td class="demo_input"><center><input type="radio" name="eth"  value="Other"/></center></td></tr>
                        </table>			
                        </td></tr>';
                        if ($_SESSION['assessment_type'] == "Adult"){   
                            echo '<tr><td colspan="2">
                                <table border="1" id="table_living">
                                    <tr><th class="tdtopic" colspan="6">Living Arrangements</th></tr>
                                    <tr><td class="liv">Alone.</td><td class="demo_input"><center><input type="radio" name="living"  value="Alone"/></center></td>
                            <td class="liv">With Family/Relatives.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Family/Relatives"/></center></td>
                        <td class="liv">With Friends.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Friends"/></center></td></tr>
                        </table>			
                        </td></tr>';}
                        else {
                            echo '<tr><td colspan="2">
                                <table border="1" id="table_living">
                                    <tr><th class="tdtopic" colspan="8">Living Arrangements</th></tr>
                                    <tr><td class="c_liv">With Parents</td><td class="demo_input"><center><input type="radio" name="living"  value="With Parents"/></center></td>
                                        <td class="c_liv">With Family/Friend.</td><td class="demo_input"><center><input type="radio" name="living"  value="With Family/Friend"/></center></td>
                                        <td class="c_liv">Foster Care.</td><td class="demo_input"><center><input type="radio" name="living"  value="Foster Care"/></center></td>
                                        <td class="c_liv">Shelter.</td><td class="demo_input"><center><input type="radio" name="living"  value="Shelter"/></center></td>
                                    </tr>
                                </table>			
                        </td></tr>';
                        }
                        
                        echo '</table><!-- end table demo -->
                        <tr><td colspan="2">
                                <table border="1" id="table_program">
                                    <tr><th class="tdtopic" colspan="6">Programs</th></tr>
                                    <tr><td class="pro">Homeless</td><td class="demo_input"><center><input type="checkbox" name="homeless"  value="1"/></center></td>
                                    <td class="pro">Chronic Care</td><td class="demo_input"><center><input type="checkbox" name="chronic_care"  value="1" /></center></td>
                                    <tr><td class="pro">Hepatitis C</td><td class="demo_input"><center><input type="checkbox" name="hep_c"  value="1"/></center></td>
                                    <td class="pro">Ryan White</td><td class="demo_input"><center><input type="checkbox" name="ryan_white"  value="1"/></center></td>
                                    <tr><td class="pro">Care Team</td><td class="demo_input"><center><input type="checkbox" name="care_team"  value="1"/></center></td><td><td>
                    </tr><tr><th class="tdtopic" colspan="6">Clinic Care</th></tr>
                <td class="pro">Brief</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="1"/></center></td>
                <td class="pro">Ongoing</td><td class="demo_input"><center><input type="radio" name="clinic_care"  value="2"/></center></td>
                </tr>
                <tr><th class="tdtopic" colspan="6">Behavioral Health</th></tr>
                <td class="pro"> w/ handoff</td><td class="demo_input"><center><input type="radio" name="bh_care"  value="w handoff"/></center></td>
                <td class="pro"> w/o handoff</td><td class="demo_input"><center><input type="radio" name="bh_care"  value="wo handoff"/></center></td>
                </tr>
                </table>
                </td></tr>
                
                    <table border="1" id="table_program">
                        <tr><th class="tdtopic" colspan="6">System Involvement</th></tr><tr>
                        <td class="eth">Singing River Svcs</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_singing_river" value="1"/></center></td>
                        <td class="eth">Gulf Coast MH</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_gulf_coast" value="1"/></center></td>
                        <td class="eth">Memorial Beh. Health</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_memorial"  value="1"/></center></td></tr>
                    </table>
                </td></tr>
                <tr><td colspan="2">
                    <table border="1" id="table_program">
                        <tr><th class="tdtopic" colspan="6">Community Connections</th></tr><tr>
                        <td class="community_connections">Harrison</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Harrison"/></center></td>
                        <td class="community_connections">Hancock</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Hancock"/></center></td>
                        <td class="community_connections">Jackson</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Jackson"/></center></td></tr>
                    </table>
                </td></tr>
                </td></tr>
                </table><!-- end table demo -->
            </div><!-- close div demo_data -->'
?><br/>
