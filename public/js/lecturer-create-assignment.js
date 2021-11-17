$( document ).ready(function() {

    $('#mark').change( function () {
        let marks = $('#mark').val();
        setCriteriaAndFeedbackModalDetails(marks, "criteria", "");

    });

    $('#markFb').change( function () {
        let marksFb = $('#markFb').val();
        setCriteriaAndFeedbackModalDetails(marksFb, "", "Fb");
    });
});

let markingCriteria = [];
let feedbackCriteria;
let topicSpecification = [];

function onCriteriaIntervalChange(divId, element) {

    let selected = $("#"+divId).val();
    let marks = $('#mark').val();

    switch (divId) {

        case "intervalSelectHd":
            calculateHdRange(marks, selected);
            showDiv(selected, "Hd");
            break;

        case "intervalSelectDn":
            calculateDnRange(marks, selected);
            showDiv(selected, "Dn");
            break;

        case "intervalSelectCr":
            calculateCrRange(marks, selected);
            showDiv(selected, "Cr");
            break;

        case "intervalSelectPp":
            calculatePpRange(marks, selected);
            showDiv(selected, "Pp");
            break;
    }
}

function showDiv(selected, grade) {

    if (selected === "2") {
        addAndRemoveClassFromInterval(grade, selected);
        $("#interval"+grade+"3").hide("fast");
        $("#interval"+grade+"2").show("fast");
    }
    else if (selected === "3") {
        addAndRemoveClassFromInterval(grade, selected);
        $("#interval"+grade+"3").show("fast");
        $("#interval"+grade+"2").hide("fast");
    }
    else {
        addAndRemoveClassFromInterval(grade, selected);
        $("#interval"+grade+"3").hide("fast");
        $("#interval"+grade+"2").hide("fast");
    }
}

function addAndRemoveClassFromInterval(grade, selected) {

    if (selected === "2") {
        $(".internal-"+grade.toLowerCase()+"2").each(function (index) {
            $(this).addClass("add-criteria-required");
        });

        $(".internal-"+grade.toLowerCase()+"3").each(function (index) {
            $(this).removeClass("add-criteria-required");
        });
    }
    else if (selected === "3") {
        $(".internal-"+grade.toLowerCase()+"2").each(function (index) {
            $(this).removeClass("add-criteria-required");
        });

        $(".internal-"+grade.toLowerCase()+"3").each(function (index) {
            $(this).addClass("add-criteria-required");
        });
    }
    else {
        $(".internal-"+grade.toLowerCase()+"2").each(function (index) {
            $(this).removeClass("add-criteria-required");
        });

        $(".internal-"+grade.toLowerCase()+"3").each(function (index) {
            $(this).removeClass("add-criteria-required");
        });
    }
}

function addCriteriaToAssignment(event) {

    let hdSub = $("#intervalSelectHd").val();
    let dnSub = $("#intervalSelectDn").val();
    let crSub = $("#intervalSelectCr").val();
    let ppSub = $("#intervalSelectPp").val();
    let containsSubCategory = false;

    if (hdSub !== "1" || dnSub !== "1" || crSub !== "1" || ppSub !== "1") {
        containsSubCategory = true;
    }

    let criteria = {
        description: $("#criteria").val(),
        mark: $("#mark").val(),
        containSubCategory: containsSubCategory,
        hdCriteria: {
            description: $("#hdCriteria").val(),
            subCriteria: [],
        },
        dnCriteria: {
            description: $("#dnCriteria").val(),
            subCriteria: [],
        },
        crCriteria: {
            description: $("#crCriteria").val(),
            subCriteria: [],
        },
        ppCriteria: {
            description: $("#ppCriteria").val(),
            subCriteria: [],
        },
        nnDescription: $("#nnCriteria").val()
    };

    criteria.hdCriteria.subCriteria = hdSub === "1" ? [] :
        populateSubCriteriaArray("hd", hdSub, criteria.hdCriteria.subCriteria);
    criteria.dnCriteria.subCriteria = dnSub === "1" ? [] :
        populateSubCriteriaArray("dn", dnSub, criteria.dnCriteria.subCriteria);
    criteria.crCriteria.subCriteria = crSub === "1" ? [] :
        populateSubCriteriaArray("cr", crSub, criteria.crCriteria.subCriteria);
    criteria.ppCriteria.subCriteria = ppSub === "1" ? [] :
        populateSubCriteriaArray("pp", ppSub, criteria.ppCriteria.subCriteria);

    return criteria;
}

function showCompleteAssignmentModel() {
    $('#creatAssignmentComplete').modal('show');
}

function isValid(formName) {
    let valid = true;
    $("."+formName+"-required").each(function (index) {
        if ($(this).val() === "") {
            valid = false;
        }
    });
    return valid;
}

function validateForm(formName) {
    let valid = true;
    $("."+formName+"-required").each(function (index) {
        if ($(this).val() === "") {
            $("."+formName+"-required-error").show();
            valid = false;
        }
    });
    if (valid) {
        $("."+formName+"-required-error").hide();
    }
    return valid;
}

function populateSubCriteriaArray (grade, selectedVal, subCriteriaPlaceHolder) {
    console.log("grade: " + grade + " SelectedVal: " + selectedVal);

    for (let i =1; i <= Number(selectedVal); i++) {
        let subCategory = {
            mark: $("#"+grade+selectedVal+"-mk"+i).text(),
            description: $("#"+grade+selectedVal+"-"+i).val(),
        };
        subCriteriaPlaceHolder.push(subCategory);
    }

    return subCriteriaPlaceHolder;
}

function populateColumnDetails(selectedVal, gradeCode) {
    switch (selectedVal) {
        case "2":
            return "<br><br>"
                + formatSubCategoryMarks($("#"+gradeCode+"2-mk1").text(), $("#"+gradeCode+"2-1").val())
                + formatSubCategoryMarks($("#"+gradeCode+"2-mk2").text(), $("#"+gradeCode+"2-2").val());

        case "3":
            return "<br><br>"
                + formatSubCategoryMarks($("#"+gradeCode+"3-mk1").text(), $("#"+gradeCode+"3-1").val())
                + formatSubCategoryMarks($("#"+gradeCode+"3-mk2").text(), $("#"+gradeCode+"3-2").val())
                + formatSubCategoryMarks($("#"+gradeCode+"3-mk3").text(), $("#"+gradeCode+"3-3").val());

        default :
            return "";
    }
}

function formatSubCategoryMarks(mark, desc) {
    return "<p>&bullet; (" + mark + ")<br>" + desc + "</p><br>";
}

function formReset(formName) {
    $("#"+formName).modal('toggle');
    $(".form-control").val("");
    $("select[name=form-select]").val(1);
    $(".internal-criteria").hide("fast");
    $(".required-error").hide("fast");

    if (formName === "addCriteriaModal") {
        addAndRemoveClassFromInterval("Hd", "1")
        addAndRemoveClassFromInterval("Dn", "1")
        addAndRemoveClassFromInterval("Cr", "1")
        addAndRemoveClassFromInterval("Pp", "1")
    }
}

function setCriteriaAndFeedbackModalDetails(marks, modal, id) {
    let r1 = 0.5*marks;
    let r2 = 0.6*marks;
    let r3 = 0.7*marks;
    let r4 = 0.8*marks;

    r1 = Number.isInteger(r1) ? r1 : r1.toFixed(1);
    r2 = Number.isInteger(r2) ? r2 : r2.toFixed(1);
    r3 = Number.isInteger(r3) ? r3 : r3.toFixed(1);
    r4 = Number.isInteger(r4) ? r4 : r4.toFixed(1);

    $('#hd'+id+'Range').text("[" + r4 + "-" + marks + "]");
    $('#dn'+id+'Range').text("[" + r3 + "-" + r4 + ")");
    $('#cr'+id+'Range').text("[" + r2 + "-" + r3 + ")");
    $('#pp'+id+'Range').text("[" + r1 + "-" + r2 + ")");
    $('#nn'+id+'Range').text("[0 -" + r1 + ")");

    if (modal === "criteria") {
        calculateHdRange(marks, $('#intervalSelectHd').val());
        calculateDnRange(marks, $('#intervalSelectDn').val());
        calculateCrRange(marks, $('#intervalSelectCr').val());
        calculatePpRange(marks, $('#intervalSelectPp').val());
    }
}

function calculateHdRange(mark, selected) {

    let min = 0.8*mark;
    let max = mark;

    switch (selected) {
        case "2":
            let v2 = 0.1*mark;
            let mid = min + v2;
            return setMarkDivisionRangeForTwo(min,mid,max, "hd");

        case "3":
            let v3 = (0.2*mark)/3;
            let first = min + v3;
            let firstMid = Math.round(first*100)/100;
            let secondMid = firstMid;
            let third = secondMid + v3;
            let thirdMid = Math.round(third*100)/100;
            let fourthMid = thirdMid;
            return setMarkDivisionRangeForThree(min, firstMid, secondMid, thirdMid, fourthMid, max, "hd");
    }
}

function calculateDnRange(mark, selected) {

    let min = 0.7*mark;
    let max = (0.8*mark);
    max = Number.isInteger(max) ? max : max.toFixed(1);

    switch (selected) {
        case "2":
            let v2 = 0.05*mark;
            let mid = min + v2;
            return setMarkDivisionRangeForTwo(min,mid,max, "dn");

        case "3":
            let v3 = (0.1*mark)/3;
            let first = min + v3;
            let firstMid = Math.round(first*100)/100;
            let secondMid = firstMid;
            let third = secondMid + v3;
            let thirdMid = Math.round(third*100)/100;
            let fourthMid = thirdMid;
            return setMarkDivisionRangeForThree(min, firstMid, secondMid, thirdMid, fourthMid, max, "dn");
    }
}

function calculateCrRange(mark, selected) {

    let min = 0.6*mark;
    let max = (0.7*mark);
    max = Number.isInteger(max) ? max : max.toFixed(1);

    switch (selected) {
        case "2":
            let v2 = 0.05*mark;
            let mid = min + v2;
            return setMarkDivisionRangeForTwo(min,mid,max, "cr");

        case "3":
            let v3 = (0.1*mark)/3;
            let first = min + v3;
            let firstMid = Math.round(first*100)/100;
            let secondMid = firstMid;
            let third = secondMid + v3;
            let thirdMid = Math.round(third*100)/100;
            let fourthMid = thirdMid;
            return setMarkDivisionRangeForThree(min, firstMid, secondMid, thirdMid, fourthMid, max, "cr");
    }
}

function calculatePpRange(mark, selected) {

    let min = 0.5*mark;
    let max = (0.6*mark);
    max = Number.isInteger(max) ? max : max.toFixed(1);

    switch (selected) {
        case "2":
            let v2 = 0.05*mark;
            let mid = min + v2;
            return setMarkDivisionRangeForTwo(min,mid,max, "pp");

        case "3":
            let v3 = (0.1*mark)/3;
            let first = min + v3;
            let firstMid = Math.round(first*100)/100;
            let secondMid = firstMid;
            let third = secondMid + v3;
            let thirdMid = Math.round(third*100)/100;
            let fourthMid = thirdMid;
            return setMarkDivisionRangeForThree(min, firstMid, secondMid, thirdMid, fourthMid, max, "pp");

    }
}

function setMarkDivisionRangeForTwo(min, middle, max, grade) {

    min = Number.isInteger(min) ? min : min.toFixed(1);
    middle = Number.isInteger(middle) ? middle : middle.toFixed(1);

    $('#'+grade+'2-mk1').text(middle + " <= m <= " + max);
    $('#'+grade+'2-mk2').text(min + " <= m < " + middle);
    /*
        $('#'+grade+'2-mk1').text(max + " - " + middle).append("<br><em><i class=\"fas fa-info-circle\" title=\"hi\"></i></em>");;
        $('#'+grade+'2-mk2').text(middle + " - " + min).append("<br><em><i class=\"fas fa-info-circle\" title=\"hi\"></i></em>");;*/
}

function setMarkDivisionRangeForThree(min, first, second, third, forth, max, grade) {

    min = Number.isInteger(min) ? min : min.toFixed(1);
    first = Number.isInteger(first) ? first : first.toFixed(1);
    second = Number.isInteger(second) ? second : second.toFixed(1);
    third = Number.isInteger(third) ? third : third.toFixed(1);
    forth = Number.isInteger(forth) ? forth : forth.toFixed(1);

    $('#'+grade+'3-mk1').text(forth + " <= m <= " + max);
    $('#'+grade+'3-mk2').text(second + " <= m < " + third);
    $('#'+grade+'3-mk3').text(min + " <= m < " + first);
}

function addTopicToTable() {
    let valid = validateForm("add-topic");

    if (valid) {
        let topic = {
            title: $("#topicTitle").val(),
            numStudents: $("#studentsAllowed").val(),
        };
        topicSpecification.push(topic);
        console.log(topicSpecification);

        let rowCount = $('#mainTable tr').length;
        $('#mainTable tr:last').after(
            "<tr>" +
            "<td align='center'>" + rowCount + "</td>" +
            "<td align='left'>" + topic.title + "</td>" +
            "<td align='center'>" + topic.numStudents + "</td>" +
            "</tr>");

        formReset("addTopicModal");
    }
}

// Adding feedback marking criteria file.
function feedbackCriteriaSaveModal() {
    let valid = validateForm("add-feedback");

    if (valid) {
        feedbackCriteria = {
            criteria: $("#criteriaFb").val(),
            marks: $("#markFb").val(),
            hdCriteria: $("#hdCriteriaFb").val(),
            dnCriteria: $("#dnCriteriaFb").val(),
            crCriteria: $("#crCriteriaFb").val(),
            ppCriteria: $("#ppCriteriaFb").val(),
            nnCriteria: $("#nnCriteriaFb").val()
        };
        return feedbackCriteria;
    }
}

function populateNewAssignmentDetails() {

    let unit = $("#unitSelect").val();
    let title = $("#title").val();
    let learningOutcome = $("#learningOutcome").val();
    let scenarios = $("#scenario").val();
    let numOfReviews = $("#numPeers").val();
    let allocationCategory = $("#allocationStrategySelect").val();
    let deadline = {
        topicSelection: $("#topicSelectionDeadLine").val(),
        assignmentSubmission: $("#assignmentSubmissionDeadLine").val(),
        assignmentSubmissionClosing: $("#assignmentSubmissionClosingDate").val(),
        assignmentMarkingOpens: $("#assignmentMarkingOpeningDate").val(),
        assignmentMarkingEnds: $("#assignmentMarkingClosingDate").val(),
        feedbackMarkingOpens: $("#feedbackMarkingOpeningDate").val(),
        feedbackMarkingEnds: $("#feedbackMarkingClosingDate").val()
    };

    let obj = {
        unit,
        title,
        learningOutcome,
        scenarios,
        numOfReviews,
        allocationCategory,
        deadline
    };

    return obj;
}

function showSuccessMessage() {
    $("#successMessage").show();
    $(".disabled-links").show();
    $(window).scrollTop(0);
}

// ========================= =============================================


// Single Topic checkbox at Topic Specification

function hideTable(d, dchecked){
    if(d.checked == true){
        document.getElementById('checked').style.display = 'none';
    } else {
        document.getElementById('checked').style.display = 'block';
    }
}