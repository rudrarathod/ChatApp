<select name="subject" class="form-select mt-1" aria-label="Select Subject" onclick="getsubject()" onblur="getsubject()">
                <option value="" disabled selected>Select branch sem & scheme to select Subject</option>
                <!-- Computer Engineering, Semester 6, Scheme I subjects -->
                <optgroup hidden id="coSem6SchemeI" label="Computer Engineering - Semester 6 - Scheme I">
                    <option value="22509">Management</option>
                    <option value="22616">Programming with Python</option>
                    <option value="22617">Mobile Application Development</option>
                    <option value="22618">Emerging Trends in Computer and Information Technology</option>
                    <option value="22619">Web-Based Application Development using PHP</option>
                </optgroup>
                <!-- Computer Engineering - Semester 4 - Scheme I -->
                <optgroup hidden id="coSem4SchemeI" label="Computer Engineering - Semester 4 - Scheme I">
                    <option value="22412">Java Programming</option>
                    <option value="22413">Software Engineering</option>
                    <option value="22414">Data Communication and Computer Network</option>
                    <option value="22415">Microprocessors</option>
                    <option value="22416">GUI Application Development using VB.Net</option>
                </optgroup>

                <!-- Computer Engineering - Semester 5 - Scheme I -->
                <optgroup hidden id="coSem5SchemeI" label="Computer Engineering - Semester 5 - Scheme I">
                    <option value="22447">Environmental Studies</option>
                    <option value="22516">Operating System</option>
                    <option value="22517">Advanced Java Programming</option>
                    <option value="22518">Software Testing</option>
                    <option value="22519">Client-Side Scripting Language</option>
                </optgroup>

                <!-- Computer Engineering - Semester 3 - Scheme I -->
                <optgroup hidden id="coSem3SchemeI" label="Computer Engineering - Semester 3 - Scheme I">
                    <option value="22316">Object Oriented Programming with C++</option>
                    <option value="22317">Data Structures using C</option>
                    <option value="22319">Computer Graphics</option>
                    <option value="22320">Digital Techniques</option>
                </optgroup>

            </select>



            
        <script <?= time() ?>>
            function getsubject() {
                var branch = document.getElementById("branch").value;
                var sem = document.getElementById("sem").value;
                var scheme = document.getElementById("scheme").value;

                // Check if the conditions are met to show the optgroup
                if (branch === "co" && sem === "6" && scheme === "I") {
                    document.getElementById("coSem6SchemeI").removeAttribute("hidden");
                } else {
                    document.getElementById("coSem6SchemeI").setAttribute("hidden", "hidden");
                    document.querySelector('select[name="subject"]').value = "";
                }
                if (branch === "co" && sem === "5" && scheme === "I") {
                    document.getElementById("coSem5SchemeI").removeAttribute("hidden");
                } else {
                    document.getElementById("coSem5SchemeI").setAttribute("hidden", "hidden");
                    document.querySelector('select[name="subject"]').value = "";
                }
                if (branch === "co" && sem === "4" && scheme === "I") {
                    document.getElementById("coSem4SchemeI").removeAttribute("hidden");
                } else {
                    document.getElementById("coSem4SchemeI").setAttribute("hidden", "hidden");
                    document.querySelector('select[name="subject"]').value = "";
                }
                if (branch === "co" && sem === "3" && scheme === "I") {
                    document.getElementById("coSem3SchemeI").removeAttribute("hidden");
                } else {
                    document.getElementById("coSem3SchemeI").setAttribute("hidden", "hidden");
                    document.querySelector('select[name="subject"]').value = "";
                }
            }
        </script>