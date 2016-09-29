<br>
                        <center><button onclick ="check('whandoff')" style= "height: 25px; width: 200px" type = "button" input id = "GRHOP_warm_handoff_check" name = "GRHOP_warm_handoff_check" value = "1">Warm Hand-off</button>
                        
                       <button onclick ="uncheck()" style= "height: 25px; width: 200px" type = "button" input id = "GRHOP_standard_uncheck" name = "GRHOP_standard_uncheck" value = "1">Uncheck All</button></center>

<!--                <center><h3>Optionally select a standard below.</h3></center>
<center><button title ="Select this button if you wish to take the GRHOP standard." onclick ="check('grhop')"   style= "height: 25px; width: 125px" type = "button" input id = "GRHOP_standard_check"   name = "GRHOP_standard_check" value="1">GRHOP Standard</button>
                        -->
                            <?php /* if ($_SESSION['university_id'] == 2) {    
                              echo '<button title ="Select this button if you wish to take the Alabama screener (Partial, front page only!)." onclick ="check(\'alabama_partial\')"   style= "height: 25px; width: 200px" type = "button" input id = "alabama_partial"   name = "alabama_partial" value="1">Alabama Screener (Partial)</button>
                              <button title ="Select this button if you wish to take the Alabama screener (Complete, both pages)." onclick ="check(\'alabama_complete\')"   style= "height: 25px; width: 225px" type = "button" input id = "alabama_complete"   name = "alabama_complete" value="1">Alabama Screener (Complete)</button>';
                              }
                              if ($_SESSION['university_id'] == 1) {
                              echo '<button title ="Select this button if you wish to take the Mississippi Initial Appointment Screener." onclick ="check(\'ms_ax\')"   style= "height: 25px; width: 200px" type = "button" input id = "ms_ax"   name = "ms_ax" value="1">MS Initial Appt.</button>
                              <button title ="Select this button if you wish to take the Mississippi Follow-up Screener." onclick ="check(\'ms_fu\')"   style= "height: 25px; width: 225px" type = "button" input id = "ms_fu"   name = "ms_fu" value="1">MS Follow-up</button>';
                              } */
                            ?>   
                       </td></table></div>
                <br>

                <!--Check-Box end.-->

                <br><br>
                <center>
                    <input id="submit"  type="submit" onclick="return formSubmit(form1);" value="Submit" >
                </center>	