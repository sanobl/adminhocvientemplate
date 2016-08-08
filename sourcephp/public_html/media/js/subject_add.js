function bindMonthShow() {
    var total = $('#money_total').val();
    total = replaceDotCharacter(total); //parseInt(total);
    // console.log('total: ' + total);
    var fromDate = convertDateDate($('#fromdate').val())
    var toDate = convertDateDate($('#todate').val());
    // var mFromDate = pa fromDate.getMonth();
    var month = parseInt(monthDiff(fromDate, toDate));
    // console.log('month:' + month);
    if (month >= 0) {
        var mFrom = parseInt(getMMYYYYFromDate(fromDate));
        var mTo = parseInt(getMMYYYYFromDate(toDate));
        var html = '<label class="control-label">Tiền thanh toán theo tháng </label>';
        html += ' <div class="controls"><div class="span12">';
        if (mFrom == mTo) {
            html += '<label class="checkbox inline">' + getMMYYYYDisplayFromDate(fromDate);
            html += '<input type="hidden" name="payment_month_hidden[]" value="' + getMMYYYYDisplayFromDate(fromDate) + '">';
            html += '<input type="text" name="payment_month[]" class="width_number60" value="' + total + '"></label>';
        } else {
            month = parseInt(month);
            var moneyPhase = Math.round(total / parseInt(month + 1));
            var totalPhase = 0;
            for (var i = 0; i <= month; i++) {
                var m = fromDate.getMonth();
                var newDate = new Date(fromDate.getFullYear(), m + i, fromDate.getDate());
                html += '<label class="checkbox inline">' + getMMYYYYDisplayFromDate(newDate);
                html += '<input type="hidden" name="payment_month_hidden[]" value="' + getMMYYYYDisplayFromDate(fromDate) + '">';
                if (i == month) {
                    moneyPhase = total - totalPhase;
                    html += '<input type="text" name="payment_month[]" class="width_number60" value="' + addCommas(moneyPhase) + '"></label>';
                } else {
                    html += '<input type="text" name="payment_month[]" class="width_number60" value="' + addCommas(moneyPhase) + '"></label>';
                    totalPhase = totalPhase + moneyPhase;
                }
            }
        }
        html += '</div></div>';

    } else {
        //loi nhap lieu
    }
    $('#thanhtoanthang').html(html);
}
function bindMonthHide() {
    $('#thanhtoanthang').html('');
}


function bindOneTimeShow() {
    var total = $('#money_total').val();
    total = replaceDotCharacter(total); //parseInt(total);
    // console.log('total: ' + total);
    var html = '<label class="control-label">Tiền thanh toán 1 lần </label>';
    html += '<input type="hidden" name="payment_onetime_hidden[]" value="All">';
    html += '<div class="controls"> <div class="span12"><input type="text" name="payment_onetime[]" class="width_number60" value="' + addCommas(total) + '" placeholder="">';
    html += '</div></div>';
    $('#thanhtoan1lan').html(html);
}

function bindOneTimeHide() {
    $('#thanhtoan1lan').html('');
}

function bindPhaseShow() {
    var total = $('#money_total').val();

    total = replaceDotCharacter(total); //parseInt(total);
    // console.log('total: ' + total);
    var phase = $('#phase').val();
    phase = parseInt(phase);
    var html = '<label class="control-label">Tiền thanh toán theo ' + phase + ' đợt </label>';
    html += ' <div class="controls"><div class="span12">';
    var moneyPhase = Math.round(total / phase);
    var totalPhase = 0;
    for (var i = 1; i <= phase; i++) {
        html += '<label class="checkbox inline"> Đợt' + i;
        html += '<input type="hidden" name="payment_phase_hidden[]" value="P' + i + '">';
        if (i == phase) {
            moneyPhase = total - totalPhase;
            html += '<input type="text" name="payment_phase[]"  class="width_number60" value="' + addCommas(moneyPhase) + '" placeholder="">';
        } else {
            html += '<input type="text" name="payment_phase[]"  class="width_number60" value="' + addCommas(moneyPhase) + '" placeholder="">';
            totalPhase = totalPhase + moneyPhase;
        }
        html += '</label>';
    }
    html += '</div></div>';
    $('#thanhtoandot').html(html);
}

function bindPhaseHide() {
    $('#thanhtoandot').html('');
}

function monthDiff(d1, d2) {
    var months;
    if (d2 < d1)
        return -1;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth() + 1;
    months += d2.getMonth() + 1;
    return months <= 0 ? 0 : months;
}

function convertDateDate(dateStr) {
    var parts = dateStr.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function getFormattedDate() {
    var todayTime = new Date();
    var month = parseInt(todayTime.getMonth() + 1);
    var day = parseInt(todayTime.getDate());
    var year = parseInt(todayTime.getFullYear());
    return month + "/" + day + "/" + year;
}

function getMMYYYYFromDate(date) {
    var month = parseInt(date.getMonth() + 1);
    var year = parseInt(date.getFullYear());
    return month + '' + year;
}

function getMMYYYYDisplayFromDate(date) {
    var month = parseInt(date.getMonth() + 1);
    var year = parseInt(date.getFullYear());
    return 'T' + month + '/' + year;
}

function FormatCurrency(ctrl) {
    //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
    if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40)
    {
        return;
    }

    var val = ctrl.value;

    val = val.replace(/,/g, "")
    ctrl.value = "";
    val += '';
    x = val.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';

    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }

    ctrl.value = x1 + x2;
}

function CheckNumeric() {
    return event.keyCode >= 48 && event.keyCode <= 57;
}


$(".splashy-remove").on("click", function () {
    $('#course_id').val($(this).attr('rel'));
    $('#editCourseForm').submit();
});
var addmore = function (e) {
    var t = e.data("last-index") || e.children().length
            , i = "__name__"
            , n = e.attr("data-prototype");
    return {
        nextIndex: t,
        prototypeHtml: n,
        prototypeName: i
    }
}
, newclasshtml = function (e) {
    return e.prototypeHtml.replace(new RegExp(e.prototypeName, "g"), e.nextIndex)
}
$(document).on('click', '.add-list-item', function (t) {
    if (t.preventDefault(),
            !$(this).attr("disabled")) {
        for (var classnew = ".collection-fields-list",
                newoption = $(this).closest(".list-class").find(classnew).first(),
                numclass = $(classnew).data("row-count-add") || 1,
                config = addmore(newoption),
                r = 1; numclass >= r; r++) {
            var a = newclasshtml(config);
            config.nextIndex++,
                    newoption.append(a).trigger("content:changed").data("last-index", config.nextIndex)
        }
    }
});
$(document).on("click", ".removeRow", function (t) {
    t.preventDefault(),
    $(this).attr("disabled") || $(this).closest("*[data-content]").trigger("content:remove").remove();
   
    
});