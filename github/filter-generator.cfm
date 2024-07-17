<!DOCTYPE html>
<html>
<head>
    <title>GitHub Filter Generator</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid mt-5">
        <h1>GitHub Filter Generator</h1>
        <form method="post" action="" class="mt-4">
            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="issueType">Issue Type:</label>
                    <select name="issueType" id="issueType" class="form-control">
                        <option value="is:issue">Issue</option>
                        <option value="is:pr">Pull Request</option>
                    </select>
                </div>

                <div class="form-group col-md-1">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control">
                        <option value="">Any</option>
                        <option value="state:open">Open</option>
                        <option value="state:closed">Closed</option>
                        <option value="state:merged">Merged</option>
                    </select>
                </div>

                <div class="form-group col-md-1">
                    <label for="author">Author:</label>
                    <select name="author" id="author" class="form-control">
                        <option value="">Any</option>
                        <option value="crcoleman71">Carrie</option>
                        <option value="sscourcy">Stephanie</option>
                        <option value="kevinkmkr">Kevin</option>
                        <option value="jsamland-ddots">Jamie</option>
                        <option value="ctrent-ddots">Christie</option>
                    </select>
                </div>

                <div class="form-group col-md-1">
                    <label for="assignee">Assignee:</label>
                    <select name="assignee" id="assignee" class="form-control">
                        <option value="">Any</option>
                        <option value="crcoleman71">Carrie</option>
                        <option value="sscourcy">Stephanie</option>
                        <option value="kevinkmkr">Kevin</option>
                        <option value="jsamland-ddots">Jamie</option>
                        <option value="ctrent-ddots">Christie</option>
                    </select>
                </div>

                <div class="form-group col-md-1">
                    <label for="mentions">Mentions:</label>
                    <select name="mentions" id="mentions" class="form-control">
                        <option value="">Any</option>
                        <option value="crcoleman71">Carrie</option>
                        <option value="sscourcy">Stephanie</option>
                        <option value="kevinkmkr">Kevin</option>
                        <option value="jsamland-ddots">Jamie</option>
                        <option value="ctrent-ddots">Christie</option>
                    </select>
                </div>

                <div class="form-group col-md-1">
                    <label for="label">Label:</label>
                    <input type="text" name="label" id="label" class="form-control">
                </div>

                <div class="form-group col-md-1">
                    <label for="project">Project:</label>
                    <input type="text" name="project" id="project" class="form-control">
                </div>

                <div class="form-group col-md-2">
                    <label for="milestone">Milestone:</label>
                    <input type="text" name="milestone" id="milestone" class="form-control">
                </div>

                <div class="form-group col-md-1">
                    <label for="dateRange">Date Range:</label>
                    <select name="dateRange" id="dateRange" class="form-control">
                        <option value="">Any</option>
                        <option value="currentMonth">Current Month</option>
                        <option value="lastMonth">Last Month</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <div id="customDateRange" class="form-group col-md-2" style="display:none;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="startDate">Start Date (YYYY-MM-DD):</label>
                            <input type="text" name="startDate" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="endDate">End Date (YYYY-MM-DD):</label>
                            <input type="text" name="endDate" id="endDate" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="generate" class="btn btn-primary">Generate</button>
        </form>

        <br>

        <cfif structKeyExists(form, "generate")>
            <cfscript>
                // Function to get the current month's date range
                function getDateRangeForCurrentMonth() {
                    var now = now();
                    var startOfMonth = createDate(year(now), month(now), 1);
                    var nextMonth = dateAdd("m", 1, startOfMonth);
                    var startOfNextMonth = createDate(year(nextMonth), month(nextMonth), 1);
                    return {
                        startDate: dateFormat(startOfMonth, "yyyy-mm-dd"),
                        endDate: dateFormat(startOfNextMonth, "yyyy-mm-dd")
                    };
                }

                // Function to get the last month's date range
                function getDateRangeForLastMonth() {
                    var now = now();
                    var startOfCurrentMonth = createDate(year(now), month(now), 1);
                    var endOfLastMonth = dateAdd("d", -1, startOfCurrentMonth);
                    var startOfLastMonth = createDate(year(endOfLastMonth), month(endOfLastMonth), 1);
                    return {
                        startDate: dateFormat(startOfLastMonth, "yyyy-mm-dd"),
                        endDate: dateFormat(startOfCurrentMonth, "yyyy-mm-dd")
                    };
                }

                // Initialize variables
                issueType = form.issueType;
                state = form.state;
                author = form.author;
                assignee = form.assignee;
                mentions = form.mentions;
                label = form.label;
                milestone = form.milestone;
                dateRange = form.dateRange;
                startDate = "";
                endDate = "";

                // Determine date range
                if (dateRange == "currentMonth") {
                    currentMonthRange = getDateRangeForCurrentMonth();
                    startDate = currentMonthRange.startDate;
                    endDate = currentMonthRange.endDate;
                } else if (dateRange == "lastMonth") {
                    lastMonthRange = getDateRangeForLastMonth();
                    startDate = lastMonthRange.startDate;
                    endDate = lastMonthRange.endDate;
                } else if (dateRange == "custom") {
                    startDate = form.startDate;
                    endDate = form.endDate;
                }

                // Construct the GitHub filter string
                filterString = issueType;
                if (state == "is:merged" && issueType == "is:issue") {
                    state = ""; // Merged state is not applicable to issues
                }
                if (len(trim(state)) > 0) {
                    filterString &= " " & state;
                }
                if (len(trim(author)) > 0) {
                    filterString &= " author:" & author;
                }
                if (len(trim(assignee)) > 0) {
                    filterString &= " assignee:" & assignee;
                }
                if (len(trim(mentions)) > 0) {
                    filterString &= " mentions:" & mentions;
                }
                if (len(trim(label)) > 0) {
                    filterString &= " label:" & label;
                }
                if (len(trim(milestone)) > 0) {
                    filterString &= " milestone:" & milestone;
                }
                if (startDate != "" && endDate != "") {
                    filterString &= " updated:>=" & startDate & " updated:<" & endDate;
                }
            </cfscript>
            <h2>Generated GitHub Filter String</h2>
            <div class="alert alert-info" role="alert">
                <span id="filter"><cfoutput>#filterString#</cfoutput></span>
                <button class="btn btn-sm btn-outline-secondary ml-3" id="copyButton">Copy</button>
            </div>
            
        </cfif>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // show/hide custom date range inputs
        document.getElementById('dateRange').addEventListener('change', function () {
            var customDateRangeDiv = document.getElementById('customDateRange');
            if (this.value === 'custom') {
                customDateRangeDiv.style.display = 'block';
            } else {
                customDateRangeDiv.style.display = 'none';
            }
        });

        document.getElementById('copyButton').addEventListener('click', function () {
            var filterString = document.querySelector('#filter').textContent;
            navigator.clipboard.writeText(filterString).then(function() {
                //alert('Copied to clipboard!');
            }).catch(function(error) {
                alert('Failed to copy: ' + error);
            });
        });
    </script>
</body>
</html>
