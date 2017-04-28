<script src="/js/moment.min.js"></script>
<script src="/js/jquery-3.2.0.min.js"></script>
@if(request()->session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ request()->session()->get('error') }}
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        Roster
    </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/rosters') }}">
                {{ csrf_field() }}
                <input type="hidden" name="employeeid" value="{{$employee->id}}">
                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Monday</label>
                    <div class="col-md-5">
                        <select name="monday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="monday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="tuesday_start" class="col-md-2 control-label">Tuesday</label>
                    <div class="col-md-5">
                        <select name="tuesday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="tuesday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="wednesday_start" class="col-md-2 control-label">Wednesday</label>
                    <div class="col-md-5">
                        <select name="wednesday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="wednesday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="thursday_start" class="col-md-2 control-label">Thursday</label>
                    <div class="col-md-5">
                        <select name="thursday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="thursday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="friday_start" class="col-md-2 control-label">Friday</label>
                    <div class="col-md-5">
                        <select name="friday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="friday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="saturday_start" class="col-md-2 control-label">Saturday</label>
                    <div class="col-md-5">
                        <select name="saturday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="saturday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="sunday_start" class="col-md-2 control-label">Sunday</label>
                    <div class="col-md-5">
                        <select name="sunday_start" class="form-control startSelector">
                            <option value="notworking">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="sunday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
            </form>
        </div>
</div>
<script>
    var startCombos = document.querySelectorAll('.startFinishSelector .startSelector');
    var finishCombos = document.querySelectorAll('.startFinishSelector .finishSelector');
    // Get a list of times spaced 30 mins apart
    var time = moment("2017-01-01 00:00:00");
    var timeList = [];
    for (var i = 0; i < 48; i++) {
        timeList.push(time.format("LT"))
        time.add(30, 'm');
    }

    $.ajax({
        url: "/api/getBusinessInfo/{{$employee->business_id}}",
        dataType: 'json'
    }).done(function (data) {
        var hours = data[0].businesshours;
        for (var i = 0; i < hours.length; i++) {
            var businessDay = hours[i];
            businessDay.open_time = moment(businessDay.open_time, 'H:m:s').format('LT');
            businessDay.close_time = moment(businessDay.close_time, 'H:m:s').format('LT');
            // console.log(businessDay)
            // add timeList from this point
            var index_start = timeList.indexOf(businessDay.open_time);
            var index_stop = timeList.indexOf(businessDay.close_time);
            startCombos[businessDay.day].dataset.startIndex = index_start;
            startCombos[businessDay.day].dataset.stopIndex = index_stop+1;
            for(var k = index_start; k < index_stop; k++){
                addOption(startCombos[businessDay.day],timeList[k])
            }
        }

        startCombos.forEach(function(combo){
            if(combo.options.length == 1){
                combo.options[0].text = "Closed"
                combo.options[0].value = "closed"
                combo.disabled= true;
            }


        })

        $.ajax({
            url: "/api/getEmployeeHours/{{$employee->id}}",
            dataType: 'json'
        }).done(function (data) {
            data.forEach(function(item,index){
                var startTime = moment(item.start_time,'H:m:s').format('LT');
                var endTime = moment(item.end_time,'H:m:s').format('LT');
                var startSel = startCombos[item.day]
                for(var i=0;i<startSel.options.length;i++){
                    if(startSel.options[i].value == startTime){
                        startSel.selectedIndex=i;
                    }
                }
                finishCombos[item.day].options.length = 0;
                var selected = parseInt(startCombos[item.day].dataset.startIndex) + startCombos[item.day].selectedIndex;
                for (var i = selected; i < startCombos[item.day].dataset.stopIndex; i++) {
                    addOption(finishCombos[item.day], timeList[i])
                }
                var endSel = finishCombos[item.day]
                for(var i=0;i<endSel.options.length;i++){
                    if(endSel.options[i].value == endTime){
                        endSel.selectedIndex=i;
                    }
                }
                endSel.disabled = false;
            })
        })

    });

    // Add the event listeners
    for (var i = 0; i < startCombos.length; i++) {
        startCombos[i].addEventListener('change', function (e) {
            var finishCombo = e.target.parentNode.parentNode.querySelector('.finishSelector');
            finishCombo.options.length = 0;
            if (e.target.selectedIndex == 0) {
                finishCombo.selectedIndex = 0;
                finishCombo.disabled = true;
                return;
            }
            var selected = parseInt(e.target.dataset.startIndex) + e.target.selectedIndex
            for (var i = selected; i < e.target.dataset.stopIndex; i++) {
                addOption(finishCombo, timeList[i])
            }
            finishCombo.disabled = false;
        })
    }

    function addOption(combo, value) {
        var option = document.createElement("option");
        option.text = value;
        option.value = value;
        combo.add(option)
    }


</script>